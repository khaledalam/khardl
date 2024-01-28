<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Payment;
use App\Models\Tenant\Setting;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Customer\CartRepository;
use App\Repositories\Customer\OrderRepository;
use App\Http\Requests\Tenant\Customer\OrderRequest;
use App\Packages\TapPayment\Charge\Charge as TapCharge;
use Exception;

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
            'address' => $user?->address

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


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->lat = $request->lat;
        $user->lng = $request->lng;

        $user->save();

        return $this->sendResponse([
            'ok' => true
        ], '');
    }
    public function paymentRedirect(OrderRequest $request){
        logger("payment redirect");
        $request->validate([
            'token_id'=>"string|required" // token id for tap payment
        ]);
        try {
            $merchant_id = Setting::first()->merchant_id;
            $order = $this->order->create($request,$this->cart);
            session([tenant()->id.'_order_customer_'.Auth::id() =>$order]);
            $charge = TapCharge::create(
                data : [
                    'amount'=> $order->total,
                    'metadata'=>[
                        'order_id'=> $order->id,
                        'customer_id'=>Auth::id()
                    ],
                ],
                merchant_id: $merchant_id,
                token_id: $request->token_id,
                redirect: route('orders.payment.response')
            );
            if ($charge['http_code'] == ResponseHelper::HTTP_OK) {
                return response()->json($charge['message']['transaction']['url'],200);
            }
        }catch(Exception $e){
            logger($e->getMessage());
        }
      
        return redirect()->route("home",[
            'status'=>false,
            'message'=>__('Payment failed, please try again')
        ]);
    }
    public function paymentResponse(Request $request,CartRepository $cart){
        try {
            logger("payment response here");
            $order = session(tenant()->id.'_order_customer_'.Auth::id());
            $charge = TapCharge::retrieve($request->tap_id);

            if($charge['message']['status'] == 'CAPTURED'){
                $order->update([
                    "payment_status"=> Payment::PAID
                ]);
                $cart->trash();
     
            }else if ($charge['message']['status'] != 'CAPTURED'){
                $order->update([
                    "payment_status"=> Payment::FAILED
                ]);
            }
            $message = ($order->payment_status  == Payment::PAID)? __("The payment was successful, your order is pending"): __('Payment failed, please try again');
        }catch(\Exception $e){
            $message =__('Payment failed, please try again');
            logger($e->getMessage());
        }
        session()->forget([tenant()->id.'_order_customer_'.Auth::id()]);
        
        return redirect()->route("home",[
            'status'=>(isset($order->payment_status ) && $order->payment_status  == Payment::PAID)?true:false,
            'message'=>$message
        ]);

    }


}
