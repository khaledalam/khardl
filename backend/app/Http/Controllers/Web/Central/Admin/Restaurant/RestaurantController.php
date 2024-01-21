<?php

namespace App\Http\Controllers\Web\Central\Admin\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Restaurant\ActivateAndDeactivateDeliveryFormRequest;
use App\Http\Services\Central\Admin\Restaurant\RestaurantService;
use App\Models\Tenant;
use App\Models\Tenant\DeliveryCompany;
use Illuminate\Http\Request;

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
}
