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
        return view('admin.notification_receipt.index', compact('user', 'notifications'));
    }
    public function create()
    {
        $user = Auth::user();
        return view('admin.notification_receipt.create', compact('user'));
    }
    public function edit($request, $notification)
    {
        $user = Auth::user();
        return view('admin.notification_receipt.edit', compact('user', 'notification'));
    }
    public function show($request, $notification)
    {
        $user = Auth::user();
        return view('admin.notification_receipt.show', compact('user', 'notification'));
    }
    public function store($request)
    {
        $data = $this->request_data($request);
        $data['is_application_purchase'] = $request->filled('is_application_purchase') ? 1 : 0;
        $data['is_branch_purchase'] = $request->filled('is_branch_purchase') ? 1 : 0;
        NotificationReceipt::create($data);
        return redirect()->route('admin.notifications-receipt.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, $notifications_receipt)
    {
        $data = $this->request_data($request);
        $data['is_application_purchase'] = $request->filled('is_application_purchase') ? 1 : 0;
        $data['is_branch_purchase'] = $request->filled('is_branch_purchase') ? 1 : 0;
        $notifications_receipt->update($data);
        return redirect()->route('admin.notifications-receipt.index')->with(['success' => __('Updated successfully')]);
    }
    public function destroy($notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications-receipt.index')->with(['success' => __('Deleted successfully')]);
    }
    public function toggleStatus($notifications_receipt)
    {
        $notifications_receipt->toggleActive();
        return redirect()->back() > with(['success' => __('Update successfully')]);
    }
    private function request_data($request)
    {
        return $request->only([
            'name',
            'email',
        ]);
    }

}
