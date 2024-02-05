<?php

namespace App\Http\Services\tenant\Driver;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\RestaurantUser;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverService
{
    use APIResponseTrait;
    public function index(Request $request)
    {
        $user = Auth::user();
        $drivers = RestaurantUser::drivers()->get();
        return view('restaurant.drivers.index',compact('user','drivers'));
    }
    public function create()
    {
        $branches = Branch::all();
        return view('restaurant.drivers.create',compact('branches'));
    }
    public function edit($request,$id)
    {
        $driver = RestaurantUser::drivers()->findOrFail($id);
        $branches = Branch::all();
        return view('restaurant.drivers.edit',compact('branches','driver'));
    }
    public function store($request)
    {
        $driver = RestaurantUser::create($this->request_data($request));
        $driver->password = Hash::make($request->password);
        $driver->assignRole('Driver');
        return redirect()->route('drivers.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, $id)
    {
        $driver = RestaurantUser::drivers()->findOrFail($id);
        $data = $this->request_data($request);
        $data['status'] = $request->status;
        if(isset($request->password)){
            $data['password'] = Hash::make($request->password);
        }
        $driver->update($data);
        return redirect()->route('drivers.index')->with(['success' => __('Updated successfully')]);
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
        return $request->only([
            'first_name',
            'last_name',
            'address',
            'branch_id',
            'email',
            'phone',
        ]);
    }

}
