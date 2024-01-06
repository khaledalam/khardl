<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Customer\CartRepository;
use App\Repositories\Customer\OrderRepository;
use App\Http\Requests\Tenant\Customer\OrderRequest;
use App\Models\Tenant\Order;


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
        session(['order_customer_'.Auth::id() =>$request->all()]);
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
            'address' => 'nullable|string|max:255',
            // 'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'], 
            // 'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
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
    public function paymentResponse(Request $request){
        try {
            $cartData = session('order_customer_'.Auth::id());
            $request->merge($cartData);
            $orderRequest = new OrderRequest($request->all());
            $this->order->create($orderRequest,$this->cart);
          
        }catch(\Exception $e){
            logger($e->getMessage());
        }
        session()->forget(['order_customer_'.Auth::id()]);
        return redirect()->route("home");

    }




}
