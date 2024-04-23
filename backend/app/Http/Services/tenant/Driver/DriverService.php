<?php

namespace App\Http\Services\tenant\Driver;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\RestaurantUser;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DriverService
{
    use APIResponseTrait;
    protected const DriverPath = 'driver_images';
    public function index(Request $request)
    {
        $user = Auth::user();
        $branches = Branch::all();
        $drivers = RestaurantUser::drivers()
            ->whenSearch($request['search'] ?? null)
            ->whenStatus($request['status'] ?? null)
            ->whenBranch($request['branch_id'] ?? null)
            ->when($user->isWorker(), function ($query) use ($user) {
                return $query->where('branch_id', $user->branch_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(config('application.perPage') ?? 20);
        return view('restaurant.drivers.index', compact('user', 'drivers','branches'));
    }
    public function create()
    {
        $branches = Branch::all();
        return view('restaurant.drivers.create', compact('branches'));
    }
    public function edit($request, $driver)
    {
        $branches = Branch::all();
        return view('restaurant.drivers.edit', compact('branches', 'driver'));
    }
    public function show($request, $driver)
    {
        $orders = $driver->driver_orders()
            ->orderBy('orders.id', 'desc')
            ->paginate(config('application.perPage') ?? 20);
        return view('restaurant.drivers.show', compact('driver', 'orders'));
    }
    public function store($request)
    {
        $driver = RestaurantUser::create($this->request_data($request));
        $driver->password = Hash::make($request->password);
        $driver->assignRole('Driver');
        if ($request->hasFile('image')) {
            $driver->image = $this->handleImage($request);
        }
        $driver->save();
        return redirect()->route('drivers.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, $driver)
    {
        $data = $this->request_data($request);
        $data['status'] = $request->status;
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImage($request, $driver->image);
        }
        $driver->update($data);
        return redirect()->route('drivers.index')->with(['success' => __('Updated successfully')]);
    }
    public function destroy($driver)
    {
        $user = Auth::user();
        if ($user->isRestaurantOwner()) {
            $driver->delete();
            return redirect()->route('drivers.index')->with(['success' => __('Deleted successfully')]);
        } else {
            return redirect()->route('drivers.index');
        }
    }
    public function handleImage($request, $update = null)
    {
        $image = tenant_asset(store_image($request->file('image'), self::DriverPath, null, $update));
        return $image;
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
            'vehicle_number'
        ]);
    }

}
