<?php

namespace App\Http\Services\tenant\Coupon;
use App\Enums\Admin\CouponTypes;
use App\Models\Tenant\Coupon;
use App\Traits\APIResponseTrait;


class CouponService
{
    use APIResponseTrait;
    public function index()
    {
        $coupons = Coupon::paginate(config('application.perPage') ?? 20);
        return view('restaurant.coupons.index',compact('coupons'));
    }
    public function create()
    {
        return view('restaurant.coupons.create');
    }
    public function edit($request, $coupon)
    {
        return view('restaurant.coupons.edit',compact('coupon'));
    }
    public function store($request)
    {
        Coupon::create($this->request_data($request));
        return redirect()->route('coupons.index')->with(['success' => __('Updated successfully')]);
    }
    public function update($request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($this->request_data($request));
        return redirect()->route('coupons.index')->with(['success' => __('Updated successfully')]);
    }
    public function changeStatus(Coupon $coupon)
    {
        $coupon->toggleStatus();
    }
    public function delete(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with(['success' => __('Deleted successfully')]);
    }
    private function request_data($request)
    {
        if($request->type == CouponTypes::FIXED_COUPON->value)$request['amount'] = $request['fixed'];
        else $request['amount'] = $request['percentage'];
        return $request->only([
            'code',
            'type',
            'amount',
            'max_use',
            'max_use_per_user',
            'minimum_cart_amount',
            'max_discount_amount',
            'active_from',
            'expire_at',
        ]);
    }

}
