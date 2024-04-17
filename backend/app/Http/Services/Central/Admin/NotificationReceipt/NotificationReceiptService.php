<?php

namespace App\Http\Services\Central\Admin\NotificationReceipt;

use App\Models\NotificationReceipt;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationReceiptService
{
    use APIResponseTrait;
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = NotificationReceipt::whenSearch($request['search'] ?? null)
            ->whenStatus($request['active'] ?? null)
            ->orderBy('id', 'desc')
            ->paginate(config('application.perPage') ?? 20);
        return view('admin.notification_receipt.index', compact('user','notifications'));
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
    public function show($request, $notification)
    {
        $user = Auth::user();
        return view('admin.notification_receipt.show', compact('user','notification'));
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
    public function destroy($notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications-receipt.index')->with(['success' => __('Deleted successfully')]);
    }
    public function handleImage($request, $update = null)
    {
        $image = tenant_asset(store_image($request->file('image'), self::DriverPath, null, $update));
        return $image;
    }
    public function toggleStatus($notifications_receipt)
    {
        $notifications_receipt->toggleActive();
        return redirect()->back()>with(['success' => __('Update successfully')]);
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
