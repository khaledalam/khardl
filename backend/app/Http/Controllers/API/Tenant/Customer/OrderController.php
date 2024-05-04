<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use Exception;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Setting;
use App\Packages\Msegat\Msegat;
use App\Traits\APIResponseTrait;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Http\Requests\Tenant\OTPRequest;
use App\Repositories\Customer\CartRepository;
use App\Repositories\Customer\OrderRepository;
use App\Http\Requests\Tenant\Customer\OrderRequest;
use App\Http\Requests\UpdateCustomerInfoAppRequest;
use App\Packages\TapPayment\Charge\Charge as TapCharge;
use App\Http\Controllers\Web\Tenant\Auth\RegisterController;

class OrderController
{
    use APIResponseTrait;
    protected $cart;
    protected $order;
    // Dependency injection not work with http client-server, Axios
    public function __construct()
    {
        $this->cart = CartRepository::get();
        $this->order = new OrderRepository();
    }
    public function store(OrderRequest $request)
    {
        return $this->order->create($request,$this->cart);
    }
    public function validateOrder(OrderRequest $request){

        return response()->json([],200);
    }
    public function index(){
        return $this->sendResponse($this->order, '');
    }

    public function user(){
        $user = Auth::user();

        return $this->sendResponse([
            'firstName' => $user?->first_name,
            'lastName' => $user?->last_name,
            'phone' => $user?->phone,
            'address' => [
                'addressValue' => $user?->address,
                'lat' => $user->lat,
                'lng' => $user->lng,
            ],
            'cashback' => $user->cashback,
            'loyalty_points' => $user->loyalty_points,
        ], '');
    }

    public function updateUser(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ],[
            'lat.required'=>__("Location is required"),
            'lng.required'=>__("Location is required")
        ]);


        $user = Auth::user();

        $shouldLogout = false;
        if ($user->phone != $request->phone) {
            // Remove verify phone status
            $user->phone_verified_at = null;
            $user->status = RestaurantUser::INACTIVE;
            $shouldLogout= true;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->lat = $request->lat;
        $user->lng = $request->lng;

        $user->save();

        if ($shouldLogout) {
            Auth::logout();
        }

        return $this->sendResponse([
            'ok' => true,
            'should_logout' => $shouldLogout
        ], __('Please re-login again'));
    }
   


    public function paymentRedirect(OrderRequest $request,CartRepository $cart){
        $request->validate([
            'token_id'=>"string|required" // token id for tap payment
        ]);

        try {
            $merchant_id = Setting::first()->merchant_id;
            $order = $this->order->create($request,$this->cart);

            $charge = TapCharge::create(
                data : [
                    'amount'=> $order->total,
                    'metadata'=>[
                        'order_data'=> json_encode($order),
                        'branch_id'=> $order->branch->id,
                        'customer_id'=>Auth::id()
                    ],
                ],
                merchant_id: $merchant_id,
                token_id: $request->token_id,
                redirect: route('orders.payment.response')
            );


            if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
                if(isset($charge['message']['source']['payment_method']) && $charge['message']['source']['payment_method'] == 'APPLE_PAY'){
            

                    if($charge['message']['status'] == 'CAPTURED'){
                        try {
                            $cart->trash();
                        }catch(Exception $e){

                        }
                        return route("payment.success");
                    }

                    return route("payment.failed");
                }
                return $charge['message']['transaction']['url'];
            }
            \Sentry\captureMessage('TAP: order charge failed  '.json_encode($charge));

        }catch(Exception $e){
            \Sentry\captureMessage('failed charge '.$e->getMessage());
        }
  
        return route("payment.failed");
    }
    public function paymentResponse(Request $request,CartRepository $cart){
        if ($request->tap_id) {
            
            $charge = TapCharge::retrieve($request->tap_id);
            if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
                if ($charge['message']['status'] == 'CAPTURED') { // payment successful
                    $cart->trash();
                    return redirect()->route("payment.success");
                }

            }
            
        }
        return redirect()->route("payment.failed");

    }


}
