<?php

namespace App\Http\Services\tenant\Coupon;
use App\Enums\Admin\CouponTypes;
use App\Models\Tenant\Coupon;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    use APIResponseTrait;
    public function index(Request $request)
    {
        $user = Auth::user();
        $coupons = Coupon::whenSearch($request['search'] ?? null)
        ->whenType($request['type'] ?? null)
        ->whenIsDeleted($request['is_deleted'] ?? null)
        ->withTrashed()
        ->paginate(config('application.perPage') ?? 20);
        return view('restaurant.coupons.index',compact('coupons','user'));
    }
    public function create()
    {
        $user = Auth::user();
        return view('restaurant.coupons.create',compact('user'));
    }
    public function edit($request, $coupon)
    {
        $user = Auth::user();
        return view('restaurant.coupons.edit',compact('coupon','user'));
    }
    public function store($request)
    {
        Coupon::create($this->request_data($request));
        return redirect()->route('coupons.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, Coupon $coupon)
    {
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
    public function restore(Coupon $coupon)
    {
        $coupon->restore();
        return redirect()->route('coupons.index')->with(['success' => __('Restored successfully')]);
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
