<?php

namespace App\Http\Controllers;

use App\Models\CentralSetting;
use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Tenant\Order;
use Google\Client;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Utils\ResponseHelper;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Enums\Admin\CouponTypes;
use App\Models\ROCustomerAppSub;
use App\Models\NotificationReceipt;
use App\Models\ROSubscriptionCoupon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ROSubscriptionInvoice;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Tap\TapBusiness;
use App\Packages\TapPayment\Lead\Lead;
use App\Models\ROCustomerAppSubInvoice;
use App\Jobs\SendApprovedBusinessEmailJob;
use App\Models\Tenant\Tap\TapBusinessFile;
use App\Http\Requests\Tenant\SaveCardRequest;
use App\Packages\TapPayment\Business\Business;
use App\Http\Requests\Tenant\RenewBranchRequest;
use App\Http\Requests\Tenant\CustomerAppSubRequest;
use App\Models\Subscription as CentralSubscription;
use App\Jobs\SendTAPLeadIDMerchantIDRequestEmailJob;
use App\Packages\TapPayment\File\File as TapFileAPI;
use App\Exports\Restaurant\ExportSubscriptionInvoice;
use App\Packages\TapPayment\Charge\Charge as TapCharge;
use App\Packages\TapPayment\Requests\CreateLeadRequest;
use App\Exports\Restaurant\ExportAppSubscriptionInvoice;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;


class TapController extends Controller
{
    public function payments(Request $request)
    {
        $user = Auth::user();
        $settings = Setting::first();
        $orders = Order::onlineCash()
        ->whenSearch($request['search']?? null)
        ->whenStatus($request['status']?? null)
        ->WhenDateString($request['date_string']??null)
        ->whenPaymentStatus($request['payment_status']?? null)
        ->recent()
        ->paginate(config('application.perPage',10));
        $ROSubscription = ROSubscription::first();
        $ROCustomerAppSubscription = ROCustomerAppSub::first();
        $ROCustomerAppSubscriptionInvoices = ROCustomerAppSubInvoice::orderBy('id','DESC')->get();
        $ROSubscriptionInvoices = ROSubscriptionInvoice::orderBy('id','DESC')->get();
        if ($ROSubscriptionInvoices && $request->filled('download') && $request->input('download') == 'csv') {
            return $this->handleDownload($request, $ROSubscriptionInvoices);
        }
        if ($ROCustomerAppSubscriptionInvoices && $request->filled('download') && $request->input('download') == 'download_app') {
            return $this->handleDownload($request, $ROCustomerAppSubscriptionInvoices);
        }

        return view('restaurant.payments', compact('user','ROCustomerAppSubscription','ROSubscriptionInvoices','ROCustomerAppSubscriptionInvoices','settings','ROSubscription','orders'));
    }
    private function handleDownload($request, $model)
    {
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $filename = "subscription_invoice_$todayDate.csv";
            return match(true){
                $model[0] instanceof ROSubscriptionInvoice => Excel::download(new ExportSubscriptionInvoice($model), $filename),
                $model[0] instanceof ROCustomerAppSubInvoice => Excel::download(new ExportAppSubscriptionInvoice($model), $filename),
                default => null
            };

        } catch (\Exception $e) {
            logger($e);
            return redirect()->route('tap.payments');
        }
    }
    public function payments_upload_tap_documents_get()
    {
        $user = Auth::user();
        $tap_files = TapBusinessFile::first();
        $files = [
            'business_logo' => 'Business Logo',
            'customer_signature' => 'Customer Signature',
            'dispute_evidence' => 'Dispute Evidence',
            'identity_document' => 'Identity Document',
            'pci_document' => 'PCI Document',
            'tax_document_user_upload' => 'TAX Document User Upload',
        ];
        return view('restaurant.payments_tap_create_business_upload_documents', compact('user', 'files', 'tap_files'));
    }

    public function payments_upload_tap_documents(Request $request)
    {
        // @TODO: handle upload tap documents logic here...

        $validationRules = [
            'business_logo' => 'required|mimes:jpeg,png,gif|file|max:16384', //16MB
            'customer_signature' => 'required|mimes:gif,jpeg,png,pdf|file|max:16384',
            'dispute_evidence' => 'required|mimes:jpeg,png,pdf|file|max:16384',
            'identity_document' => 'required|mimes:jpeg,png,pdf|file|max:16384',
            'pci_document' => 'required|mimes:jpeg,png,pdf|file|max:16384',
            'tax_document_user_upload' => 'required|mimes:jpeg,png,pdf|file|max:16384',
        ];

        $request->validate($validationRules);

        // Iterate through the keys
        $files = ['id' => 1];
        foreach ($validationRules as $key => $rule) {
            $file = $request->file($key);
            $title = ucwords(str_replace('_', ' ', $key));
            $response = TapFileAPI::create([
                'file' => $file,
                'purpose' => $key,
                'title' => $title
            ]);
            if ($response['http_code'] != ResponseHelper::HTTP_OK) {
                return redirect()->back()->with('error', 'Failed to upload ' . $title);
            }
            $files[$key . '_path'] = store_image($file, TapBusinessFile::STORAGE, $key);
            $files[$key . '_id'] = $response['message']['id'];
        }
        TapBusinessFile::updateOrCreate([
            'id' => 1
        ], $files);

        return redirect()->route("tap.payments_submit_tap_documents_get")->with('success', __('Files successfully added.'));

    }

    public function payments_submit_tap_documents_get()
    {
        $user = Auth::user();
        $restaurant_name = Setting::first()->restaurant_name;
        $tenant_id = tenant()->id;
        $facility_name = '';
        tenancy()->central(function () use ($tenant_id, &$iban, &$facility_name) {
            $user = Tenant::find($tenant_id)->user;
            $facility_name = $user->traderRegistrationRequirement?->facility_name;
        });
        return view('restaurant.payments_tap_create_business_submit_documents', compact( 'user', 'facility_name', 'restaurant_name'));
    }

    public function payments_submit_tap_documents(CreateBusinessRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $files = TapBusinessFile::first();
        $types = [
            'business_logo_id',
            'customer_signature_id',
            'dispute_evidence_id',
            'pci_document_id',
            'tax_document_user_upload_id',
        ];
        foreach ($types as $id) {
            $data['entity']['documents'][] = [
                'type' => "License",
                "files" => [
                    $files->{$id}
                ]
            ];
        }
        $user = Auth::user();
        $business = Business::create($data);
        if ($business['http_code'] != ResponseHelper::HTTP_OK) {
            return redirect()->back()
                ->withErrors([
                    __('Failed to create business'),
                    $business['message']
                ])
                ->withInput($request->input());
        }

        TapBusiness::create([
            'data' => $data,
            'business_id' => $business['message']['id'],
            "destination_id" => $business['message']['destination_id'],
            "status" => $business['message']['status'],
            "entity_id" => $business['message']['entity']['id'],
            "wallet_id" => $business['message']['entity']['wallets'][0]['id'],
            'user_id' => $user->id
        ]);

        if ($business['message']['status'] == 'Active') {
            $user->tap_verified = true;
            $user->save();
            SendApprovedBusinessEmailJob::dispatch($user);
        }

        return redirect()->route('tap.payments')->with('success', __('New Business has been created successfully.'));

    }

    public function payments_submit_card_details(SaveCardRequest $request)
    {

        $data = $request->validated();
        $sub = ROSubscription::first();
        $centralSubscription = tenancy()->central(function(){
            return CentralSubscription::first();
        });
        if($sub){
            if($sub->status == ROSubscription::SUSPEND ){
                $n_branches = 0;
                $branches = Branch::where('active',true)->count();
                if($branches == 0 && $sub->number_of_branches == 0){
                    $n_branches = 1;
                }
                $chargeData=  ROSubscription::serviceCalculate(ROSubscription::RENEW_AFTER_ONE_YEAR, $n_branches ,$centralSubscription->id);
            }else {
                $chargeData=  ROSubscription::serviceCalculate($data['type'],  $data['n_branches'],$centralSubscription->id);
            }

        }else {
            if($request->coupon_code){
                $chargeData = tenancy()->central(function()use($data,$request,$centralSubscription){
                    $coupon = ROSubscriptionCoupon::
                    where('code',$request->coupon_code)
                    ->where(NotificationReceipt::is_branch_purchase,true)
                    ->where(function ($query) {
                        $query->whereColumn('max_use', '>', 'n_of_usage')
                              ->orWhereNull('max_use');
                    })->first();
                    if(!$coupon) return $coupon;
                    return [
                        'cost'=> ($coupon->type == CouponTypes::FIXED_COUPON->value)? $centralSubscription->amount * $data['n_branches'] - $coupon->amount : (( $centralSubscription->amount * $data['n_branches']) - ((($centralSubscription->amount * $data['n_branches']) * $coupon->amount) / 100)),
                        'number_of_branches'=> $data['n_branches'],
                        'coupon_code'=>$request->coupon_code,
                        'sub_amount'=>$centralSubscription->amount * $data['n_branches']
                    ];
                });
                if(!$chargeData){
                    return redirect()->route('restaurant.service')->with('error', __('Invalid coupon'));

                }


            }else {
                $chargeData = ROSubscription::serviceCalculate(ROSubscription::NEW, $data['n_branches'],$centralSubscription->id);
            }
        }

        $payload = [
            'amount'=> $chargeData['cost'],
            'metadata'=>[
                'restaurant_id'=> tenant()->id,
                'subscription'=> $data['type'],
                'n-branches'=> $chargeData['number_of_branches'],
                'subscription_id'=>$centralSubscription->id
            ]
        ];
        if(isset($chargeData['coupon_code'])){
            $payload['metadata']['coupon_code'] = $chargeData['coupon_code'];
            $payload['metadata']['sub_amount'] = $chargeData['sub_amount'];
        }
        $charge = TapCharge::createSub(
            data : $payload,
            token_id: $data['token_id'],
            redirect: route('tap.payments_redirect')
        );
        if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
            if(isset($charge['message']['transaction']['url'])){
                return redirect($charge['message']['transaction']['url']);

            }
        }
        \Sentry\captureMessage('TAP: sub failed charge '.json_encode($charge));




        return redirect()->route('restaurant.service')->with('error', __('Error occur please try again'));
    }
    // public function payments_submit_lead_get(){
    //     $user = Auth::user();
    //     $restaurant_name = Setting::first()->restaurant_name;
    //     $tenant_id = tenant()->id;
    //     $iban = '';
    //     $facility_name = '';
    //     tenancy()->central(function () use ($tenant_id, &$iban, &$facility_name) {
    //         $user = Tenant::find($tenant_id)->user;
    //         $iban = $user->traderRegistrationRequirement?->IBAN;
    //         $facility_name = $user->traderRegistrationRequirement?->facility_name;
    //     });
    //     return view('restaurant.payments_tap_create_lead',compact('iban','facility_name','restaurant_name','user'));
    // }

    // Central domain
    public function payments_submit_lead($tenant,CreateLeadRequest $request) {
        $tenant = Tenant::findOrFail($tenant);
        $data = $request->all();

        // $tenant_id = tenant()->id;
        // $userBankIban = '';
        // tenancy()->central(function () use ($tenant_id, &$userBankIban,) {
        //     $user = Tenant::find($tenant_id)->user;
        //     $userBankIban = $user->traderRegistrationRequirement?->IBAN;
        // });

        // Autofill data from our side to simplify the flow
        // $data['user']['name']['title'] = 'Mr';
        // $data['user']['phone'][0]['type'] = 'WORK';
        // $data['user']['email'][0]['type'] = 'WORK';
        // $data['wallet']['bank']['account']['iban'] = $userBankIban;
        if($request->file('brand.logo')){
            $restaurant_logo = TapFileAPI::create([
                'file' => $request->file('brand.logo'),
                'purpose' => 'business_logo',
                'title' => "Restaurant Logo"
            ]);
            $data['brand']['logo']=$restaurant_logo['message']['id'];

        }
        if($request->file("wallet.bank.documents.0.images.0")){
            $bank_statement = TapFileAPI::create([
                'file' => $request->file("wallet.bank.documents.0.images.0"),
                'purpose' => 'identity_document',
                'title' => "Bank Statement"
            ]);
            $data['wallet']['bank']['documents'][0]['images'][0]=$bank_statement['message']['id'];

        }
        if($request->file("entity.tax.documents.0.images.0")){
            $tax = TapFileAPI::create([
                'file' => $request->file("entity.tax.documents.0.images.0"),
                'purpose' => 'tax_document_user_upload',
                'title' => "Tax Document"
            ]);
            $data['entity']['tax']['documents'][0]['images'][0]=$tax['message']['id'];

        }



        $response = Lead::connect($data);
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            logger($request);

            $update_tap_sheet = CentralSetting::first()?->auto_update_tap_sheet;

            $tenant->run(function()use($response, $update_tap_sheet){
                Setting::first()->update([
                    'lead_id' => $response['message']['id'],
                    'lead_response' => $response['message']
                ]);
                SendTAPLeadIDMerchantIDRequestEmailJob::dispatch(
                    user: RestaurantUser::first(),
                    lead_id :  $response['message']['id'],
                );

                if ($update_tap_sheet) {
                   $this->UpdateTAPSheet($response);
                }

            });



            return redirect()->route('admin.view-restaurants',['tenant'=>$tenant])->with('success', __('Your tap account has been created successfully, waiting for approval and we will contact you then'));
        }
        return redirect()->back()
        ->withInput($request->input())
        ->with('error', $response['message']);

    }

    private function UpdateTAPSheet($response)
    {
        // Update the TAP shared Google sheet (add LEAD ID)
        // https://docs.google.com/spreadsheets/d/15z09Bphnn6D6fEQSWa5jrlqzkdhbNsr5nrOyCmH2TVo/edit#gid=0
        $SHEET_ID = '15z09Bphnn6D6fEQSWa5jrlqzkdhbNsr5nrOyCmH2TVo';

        $client = new Client();
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $path = base_path() . '/config/true-campus-423716-e3-72946e436b30.json';
        $client->setAuthConfig($path);
        $service = new \Google_Service_Sheets($client);

        $newRow = [
            now(),
            'live',
            $response['message']['id'],
            ' ',
            Setting::first()?->restaurant_name,
            $response['message']
        ];
        $rows = [$newRow];
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues($rows);
        $range = 'Sheet1';
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $service->spreadsheets_values->append($SHEET_ID, $range, $valueRange, $options);
    }

    public function payments_redirect(Request $request){

        if ($request->tap_id) {
            $charge = TapCharge::retrieveSub($request->tap_id);
            if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
                sleep(4);
                if ($charge['message']['status'] == 'CAPTURED') { // payment successful
                    if(isset($charge['message']['metadata']['branch_id'])){
                        return redirect()->route('restaurant.branches')
                        ->with('success', __('You branch has been activated successfully'));
                    }
                    if(isset($charge['message']['metadata']['customer_app'])){
                        return redirect()->route('restaurant.service')
                        ->with('success', __('You have successfully subscribed to the application. The application will be activated in the coming days'));
                    }
                    return redirect()->route('restaurant.service')->with('success', __('You can now add a branch'));
                } else {
                    if(isset($charge['message']['metadata']['branch_id'])){
                        return redirect()->route('restaurant.branches')
                        ->with('error', __("The payment failed, and the subscription fee has not been paid"));
                    }
                    return redirect()->route('restaurant.service')
                    ->with('error', __("The payment failed, and the subscription fee has not been paid"));
                }

            }
        }
        return redirect()->route('restaurant.service')->with('error', __('Error occur please try again'));
    }
    public function renewBranch(RenewBranchRequest $request){
        $data = $request->validated();
        $sub = ROSubscription::first();
        $centralSubscription = tenancy()->central(function(){
            return CentralSubscription::first();
        });
        $branch_cost =number_format($sub->calculateDaysLeftCost($centralSubscription->amount),2);
        $charge = TapCharge::createSub(
            data : [
                'amount'=> $branch_cost,
                'metadata'=>[
                    'restaurant_id'=> tenant()->id,
                    'subscription'=> ROSubscription::RENEW_BRANCH,
                    'branch_id'=> $request->currentBranch,
                    'n-branches'=> 1,
                    'subscription_id'=>$centralSubscription->id
                ],
            ],
            token_id: $data['token_id'],
            redirect: route('tap.payments_redirect')
        );
        if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
            if(isset($charge['message']['transaction']['url'])){
                return redirect($charge['message']['transaction']['url']);
            }
        }
        \Sentry\captureMessage('TAP:  sub failed renew branch '.json_encode($charge));


        return redirect()->route('restaurant.service')->with('error', __('Error occur please try again'));
    }
    public function  payments_submit_customer_app(CustomerAppSubRequest $request){
        $data = $request->validated();
        $sub = ROCustomerAppSub::first();
        [$AppSubscription,$AppLifetimeSubscription] = tenancy()->central(function(){
            return [
                CentralSubscription::skip(1)->first(),
                CentralSubscription::skip(2)->first(),

            ];
        });
        if($request->customer_app_sub_option == ROCustomerAppSub::LIFETIME_SUBSCRIPTION){
            $type = ROCustomerAppSub::LIFETIME_SUBSCRIPTION;
            $amount = $AppLifetimeSubscription->amount;
            $AppSubscription_id = $AppLifetimeSubscription->id;

        }else {
            $amount = $AppSubscription->amount;
            $AppSubscription_id = $AppSubscription->id;
            if($sub){
                $type = ROSubscription::RENEW_AFTER_ONE_YEAR;
            }else {
               $type = ROSubscription::NEW;
            }
        }
        if($request->coupon_code && !$sub){
            $chargeData = tenancy()->central(function()use($request,$AppLifetimeSubscription){
                $coupon = ROSubscriptionCoupon::
                where('code',$request->coupon_code)
                ->where($request->customer_app_sub_option,true)
                ->where(function ($query) {
                    $query->whereColumn('max_use', '>', 'n_of_usage')
                          ->orWhereNull('max_use');
                })->first();
                if(!$coupon) return $coupon;
                return [
                    'cost'=> ($coupon->type == CouponTypes::FIXED_COUPON->value)? $AppLifetimeSubscription->amount  - $coupon->amount : ( $AppLifetimeSubscription->amount  - (($AppLifetimeSubscription->amount  * $coupon->amount) / 100)),
                    'coupon_code'=>$request->coupon_code,
                    'sub_amount'=>$AppLifetimeSubscription->amount
                ];
            });
            if(!$chargeData){
                return redirect()->route('restaurant.service')->with('error', __('Invalid coupon'));
            }

        }

        $payload = [
            'amount'=> $amount,
            'metadata'=>[
                'restaurant_id'=> tenant()->id,
                'subscription'=> $type,
                'customer_app'=> true,
                'subscription_id'=>$AppSubscription_id
            ],
        ];
        if(isset($chargeData)){
            $payload['amount'] = $chargeData['cost'];
            $payload['metadata']['coupon_code'] = $chargeData['coupon_code'];
            $payload['metadata']['sub_amount'] = $chargeData['sub_amount'];
        }
        $charge = TapCharge::createSub(
            data : $payload,
            token_id: $data['token_id'],
            redirect: route('tap.payments_redirect')
        );
        if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
            if(isset($charge['message']['transaction']['url'])){
                return redirect($charge['message']['transaction']['url']);

            }
        }
        \Sentry\captureMessage('TAP: app customer sub failed charge '.json_encode($charge));




       return redirect()->route('restaurant.service')->with('error', __('Error occur please try again'));
   }
}
