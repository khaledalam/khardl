<?php

namespace App\Http\Services\Central\Admin\Dashboard;

use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\Setting;

class DashboardService
{
    public function index(Request $request)
    {
        $user = Auth::user();

        //
        $restaurantsAll = Tenant::with("primary_domain")->get();

        // not complete register step2
        $restaurantsOwnersNotUploadFiles = User::doesntHave('traderRegistrationRequirement')->count();

        $restaurantsLive = 0;
        $customers = 0;
        $totalOrders = 0;
        $pendingOrders = 0;
        $completedOrders = 0;
        $acceptedOrders = 0;
        $cancelledOrders = 0;
        $readyOrders = 0;
        $self = $this;
        foreach ($restaurantsAll as $restaurant) {
            $restaurant->run(static function ($tenant) use (
                &$restaurantsLive,
                &$customers,
                &$totalOrders,
                $self,
                &$pendingOrders,
                &$acceptedOrders,
                &$completedOrders,
                &$cancelledOrders,
                &$readyOrders,
                ) {
                $setting = Setting::first();
                if ($setting->is_live) {
                    $restaurantsLive++;
                }

                $currentMonth = Carbon::now()->month;
                $customers += RestaurantUser::customers()->whereMonth('created_at', '=', $currentMonth)->count();
                $orders = Order::query();
                $pendingOrders += $self->getOrderStatusCount(clone $orders, 'pending');
                $acceptedOrders += $self->getOrderStatusCount(clone $orders, 'accepted');
                $completedOrders += $self->getOrderStatusCount(clone $orders, 'completed');
                $cancelledOrders += $self->getOrderStatusCount(clone $orders, 'cancelled');
                $readyOrders += $self->getOrderStatusCount(clone $orders, 'ready');
                $totalOrders += $orders->count();
            });
        }
        $restaurantsAll = count($restaurantsAll);



        return view(
            'admin.dashboard',
            compact(
                'user',
                'restaurantsAll',
                'restaurantsOwnersNotUploadFiles',
                'restaurantsLive',
                'customers',
                'totalOrders',
                'acceptedOrders',
                'pendingOrders',
                'completedOrders',
                'cancelledOrders',
                'readyOrders',

            )
        );
    }
    private function getOrderStatusCount($orders, $scope)
    {
        return $orders->$scope()->count();
    }
}
