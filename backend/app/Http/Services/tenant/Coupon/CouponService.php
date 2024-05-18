<?php

namespace App\Http\Services\tenant\Coupon;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Coupon;
use App\Enums\Admin\CouponTypes;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    use APIResponseTrait;
    public function index(Request $request,$branchId)
    {
        $user = Auth::user();
        $coupons = Coupon::where('branch_id',$branchId)->whenSearch($request['search'] ?? null)
        ->whenType($request['type'] ?? null)
        ->whenIsDeleted($request['is_deleted'] ?? null)
        ->withTrashed()
        ->paginate(config('application.perPage') ?? 20);

        $branches = Branch::all()->when($user->isWorker(),function($q)use($user){
            return $q->where('id',$user->branch_id);
        });
        return view('restaurant.coupons.index',compact('coupons','user','branches','branchId'));
    }
    public function create($branchId)
    {
        $user = Auth::user();
        return view('restaurant.coupons.create',compact('user','branchId'));
    }
    public function edit($request, $coupon,$branchId)
    {
        $user = Auth::user();
        return view('restaurant.coupons.edit',compact('coupon','user','branchId'));
    }
    public function store($request,$branchId)
    {
        Coupon::create($this->request_data($request));
        return redirect()->route('coupons.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, Coupon $coupon,$branchId)
    {
        $coupon->update($this->request_data($request));
        return redirect()->route('coupons.index')->with(['success' => __('Updated successfully')]);
    }
    public function changeStatus(Coupon $coupon,$branchId)
    {
        $coupon->toggleStatus();
    }
    public function delete(Coupon $coupon,$branchId)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with(['success' => __('Deleted successfully')]);
    }
    public function restore(Coupon $coupon,$branchId)
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
