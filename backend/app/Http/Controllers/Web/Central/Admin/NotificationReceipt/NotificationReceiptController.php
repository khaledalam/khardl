<?php

namespace App\Http\Controllers\Web\Central\Admin\NotificationReceipt;

use App\Http\Controllers\Web\BaseController;
use App\Http\Services\Central\Admin\NotificationReceipt\NotificationReceiptService;
use App\Models\NotificationReceipt;
use Illuminate\Http\Request;

class NotificationReceiptController extends BaseController
{
    public function __construct(private NotificationReceiptService $notificationService) {
    }
    public function index(Request $request)
    {
        return $this->notificationService->index($request);
    }
    public function create(Request $request)
    {
        return $this->notificationService->create();
    }
    public function store(DriverStoreFormRequest $request)
    {
        return $this->notificationService->store($request);
    }
    public function edit(Request $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('update', $driver);
        return $this->notificationService->edit($request,$driver);
    }
    public function show(Request $request, NotificationReceipt $notifications_receipt)
    {
        return $this->notificationService->show($request,$notifications_receipt);
    }
    public function update(DriverUpdateFormRequest $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('update', $driver);
        return $this->notificationService->update($request, $driver);
    }
    public function destroy(Request $request, NotificationReceipt $notifications_receipt)
    {
        return $this->notificationService->destroy($notifications_receipt);
    }
    public function toggleStatus(Request $request, NotificationReceipt $notifications_receipt)
    {
        return $this->notificationService->toggleStatus($notifications_receipt);
    }
}
