<?php

namespace App\Http\Controllers\Web\Central\Admin\Restaurant;

use App\Models\Log;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Enums\Admin\LogTypes;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Setting;
use App\Models\ROCustomerAppSub;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\DeliveryCompany;
use App\Models\Tenant\RestaurantStyle;
use App\Http\Requests\UpdateCustomerAppRequest;
use App\Packages\TapPayment\Merchant\Merchant as TapMerchant;
use App\Http\Services\Central\Admin\Restaurant\RestaurantService;
use App\Http\Requests\Central\Restaurant\ActivateAndDeactivateDeliveryFormRequest;
use App\Models\ROSubscription;

class RestaurantController extends Controller
{
    public function __construct(private RestaurantService $restaurantService)
    {
    }
    public function index(Request $request)
    {
        return $this->restaurantService->index($request);
    }
    public function show(Tenant $tenant)
    {
        return $this->restaurantService->show($tenant);
    }
    public function restaurantsAppRequested(Request $request){
        return $this->restaurantService->appRequested($request);
    }
    public function activeAndDeactivateDelivery(ActivateAndDeactivateDeliveryFormRequest $request, Tenant $tenant)
    {
        return $tenant->run(function ($tenant) use ($request) {
            $company = DeliveryCompany::where("module", $request->module)->first();
            if ($company->status == false) {
                if (!$company->module->verifyApiKey($request->api_key)) {
                    return redirect()->back()->with([
                        'error' => __("Api Key not correct, please contact :module support team to ensure about it", ['module' => $request->module]),
                    ]);
                }
            }

            $company->update([
                'status' => !$company->status,
                'api_key' => $request->api_key
            ]);
            $message = ($company->status) ? __(':module has been successfully activated') : __(':module has been successfully deactivated');
            return redirect()->back()->with([
                'success' => __($message, ['module' => __($request->module)]),
            ]);
        });
    }
    public function tapLead(Tenant $tenant){
        $lead_response = $tenant->run(function(){
            return Setting::first()->lead_response;
        });
        return response()->json($lead_response,200);
    }
    public function updateCustomerApp(Tenant $tenant,UpdateCustomerAppRequest $request){
        $tenant->run(function()use($request,$tenant){
            $customer_app = ROCustomerAppSub::first();
            if($customer_app->created_at == $customer_app->updated_at){
                $customer_app->start_at = now();
            }
            if($request->android_url && $request->ios_url){
                $customer_app->android_url = $request->android_url;
                $customer_app->ios_url = $request->ios_url;
                $customer_app->status = ROSubscription::ACTIVE;
            }else {
                $customer_app->android_url = null;
                $customer_app->ios_url = null;
                $customer_app->status = ROCustomerAppSub::REQUESTED;
            }

            if($request->icon){
                $customer_app->icon = store_image($request->file('icon'), RestaurantStyle::STORAGE, 'customer_app');
            }

            $customer_app->save();
        });
        return redirect()->back()->with('success',__('Customer app has been updated successfully'));

    }
    public function updateConfig(Tenant $tenant,Request $request){


        if($request->merchant_id){
            $merchant = TapMerchant::retrieve($request->merchant_id);
            if ($merchant['http_code'] != ResponseHelper::HTTP_OK) {
                return redirect()->back()->with('error',__('Invalid Merchant id'));
            }
        }
        $oldMerchantId=$tenant->run(function()use($request){
            $setting = Setting::first();
            $merchantId= $setting->merchant_id;
            $setting->update([
                'merchant_id'=>$request->merchant_id,
                'lead_id'=>$request->lead_id
            ]);
            return $merchantId;

        }) ?? 'NULL';
        $actions = [
            'en' => "[ok] Admin has update old  merchant id ($oldMerchantId)",
            'ar' => "[تم] تم تحديث رقم التعريف القديم ($oldMerchantId) بوابة الدفع الخاصة بمطعم",
        ];

        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::TAPRestaurantMerchantID,
            'metadata' => [
                'from' => $oldMerchantId,
                'to'=> $request->merchant_id
            ]

        ]);

        return redirect()->back()->with('success',__('restaurant setting has been update successfully'));

    }
}
