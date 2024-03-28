<?php

namespace App\Http\Services\tenant\Order;

use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Http\Requests\Tenant\Customer\OrderRequest;
use App\Http\Resources\Web\Tenant\ItemResource;
use App\Models\Tenant;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Cart;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Item;
use App\Models\Tenant\Order;
use App\Models\Tenant\OrderStatusLogs;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\Product;
use App\Models\User;
use App\Repositories\Customer\CartRepository;
use App\Repositories\Customer\OrderRepository;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;

class OrderService
{
    use APIResponseTrait;
    public function getList($request)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders = Order::with('payment_method')
        ->recent()
        ->whenSearch($request['search']?? null)
        ->whenStatus($request['status']?? null)
        ->WhenDateString($request['date_string']??null)
        ->whenPaymentStatus($request['payment_status']?? null)
        ->paginate(config('application.perPage')??20);
        return view('restaurant.orders.list', compact('user', 'orders'));
    }

    public function inquiry($request)
    {
        $order = null;
        $orderStatusLogs = null;
        $locale = app()->getLocale();
        $user = Auth::user();

        if ($request->has('order_id')) {
            $validatedData = $request->validate([
                'order_id' => 'required|string|min:16|max:16',
            ]);

            $order_id = $validatedData['order_id'];

            $order = Tenant\Order::find($order_id)->first();
            $orderStatusLogs = OrderStatusLogs::all()->sortByDesc("created_at");
        }

        return view('admin.order-inquiry', compact('user','order', 'locale', 'orderStatusLogs'));

    }
    public function create()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $deliveryTypes = DeliveryType::all();
        $branches = Branch::all();
        return view('restaurant.orders.add', compact('user', 'deliveryTypes', 'branches'));
    }
    public function addOrder($request)
    {
        $user = $this->checkUser($request);
        $cart = $this->createCart($request, $user);
        $this->createOrder($request, $cart, $user);
        return redirect()->route('restaurant.orders_all')->with('success',__('Order has been created successfully'));
    }
    private function createOrder($request, $cart, $user)
    {
        $delivery_type = DeliveryType::findOrFail($request->delivery_type_id);
        $orderRequest = new OrderRequest([
            'payment_method' => PaymentMethod::CASH_ON_DELIVERY,
            'delivery_type' => $delivery_type->name,
            'shipping_address' => $request->shipping_address,
            'order_notes' => $request->order_notes,
            'manual_order_first_name' => $request->first_name,
            'manual_order_last_name' => $request->last_name,
        ]);
        $order = new OrderRepository();
        return $order->create($orderRequest, $cart, $user);
    }
    private function createCart($request, $user)
    {
        $products = $request->products;
        $new_cart = (new CartRepository)->initiate($user->id);
        foreach ($products as $product => $quantities) {
            foreach ($quantities as $key => $quantity) {
                $selectedCheckbox = null;
                if(isset($request->product_options[$product][$key]['checkbox_input'])){
                    $selectedCheckbox = $request->product_options[$product][$key]['checkbox_input'];
                }
                $selectedRadio = null;
                if(isset($request->product_options[$product][$key]['selection_input'])){
                    $selectedRadio = $request->product_options[$product][$key]['selection_input'];
                }
                $selectedDropdown = null;
                if(isset($request->product_options[$product][$key]['dropdown_input'])){
                    $selectedDropdown = $request->product_options[$product][$key]['dropdown_input'];
                }
                $addItemToCartRequest = new AddItemToCartRequest([
                    'item_id' => $product,
                    'quantity' => $quantity,
                    'branch_id' => $request->branch_id,
                    'selectedCheckbox' => $selectedCheckbox,
                    'selectedRadio' => $selectedRadio,
                    'selectedDropdown' => $selectedDropdown,
                ]);
                $new_cart->add($addItemToCartRequest);
            }
        }
        return $new_cart;
    }/*
    public function readyOptionsNested($options)
    {
        foreach ($options as $key => $option) {
            foreach ($option as $subKey => $subOption) {
                $options[$key][$subKey] = [(int)$key,(int)$subKey];
            }
        }
        return $options;
    }
    public function readyOptions($options)
    {
        foreach ($options as $key => $option) {
            $options[$key] = [(int)$option,(int)$option];
        }
        return $options;
    } */
    public function searchProducts($request)
    {
        $items = Item::whenSearch($request['term'] ?? null)
            ->whenBranch($request['branch_id'] ?? null)
//            ->take(5)
            ->get();
        logger($items);
        return $this->sendResponse(ItemResource::collection($items), '');
    }
    public function getProduct($request, Item $item)
    {
        return $this->sendResponse(new ItemResource($item), '');
    }
    private function checkUser($request)
    {
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name ?? $request->first_name,
                'address' => $request->shipping_address,
            ]
        );
        return $user;
    }
    public function listUnavailableProducts($request)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $products = Item::with(['category','branch','user'])
        ->unAvailable()
        ->recent()
        ->paginate(config('application.perPage')??20);
        return view('restaurant.orders.unavailable_products', compact('user','products'));
    }
    public function changeProductAvailability(Item $item)
    {
        $item->toggleAvailability();
    }
}
