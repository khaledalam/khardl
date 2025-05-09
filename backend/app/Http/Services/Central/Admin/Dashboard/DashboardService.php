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
use Illuminate\Support\Facades\Cache;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardService
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->has('refresh')) {
            Cache::delete('cache_Admin_Summary_Page');
            return redirect()->route('admin.dashboard');
        }

        [
            $restaurantsAll,
            $restaurantsOwnersNotUploadFiles,
            $restaurantsLive,
            $totalOrders,
            $acceptedOrders,
            $pendingOrders,
            $completedOrders,
            $cancelledOrders,
            $readyOrders,
            $receivedByResOrders,
            $rejectedOrders,
            $monthVisitors,
            $dailyVisitors
        ] = $this->cacheItems();
        $refresh = 1;
        return view(
            'admin.dashboard',
            compact(
                'user',
                'restaurantsAll',
                'restaurantsOwnersNotUploadFiles',
                'restaurantsLive',
                'totalOrders',
                'acceptedOrders',
                'pendingOrders',
                'completedOrders',
                'cancelledOrders',
                'readyOrders',
                'receivedByResOrders',
                'rejectedOrders',
                'monthVisitors',
                'dailyVisitors',
                'refresh'
            )
        );
    }
    private function getOrderStatusCount($orders, $scope)
    {
        return $orders->$scope()->count();
    }
    public function dailyVisitors()
    {
        return $this->getDaily(14);
    }
    public function getDaily($count)
    {
        $chart_options = [
            'chart_title' => __('Daily visitors'),
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Visitor',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'aggregate_field' => 'count',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => $count ,
            'chart_color' => '194, 218, 8',
        ];
        return new LaravelChart($chart_options);
    }
    public function monthlyVisitors()
    {
        return $this->getMonthly();
    }
    public function getMonthly()
    {
        $chart_options = [
            'chart_title' => __('Monthly visitors'),
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Visitor',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'aggregate_field' => 'count',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => 6 * 30,
            'chart_color' => '0, 158, 247',
        ];
        return new LaravelChart($chart_options);
    }
    public function cacheItems(){
        $cacheKey = 'cache_Admin_Summary_Page';
        return Cache::remember($cacheKey, config("application.$cacheKey", 24 * 60 * 60), function () {
            $restaurantsAll = Tenant::with("primary_domain")->get();
            // not complete register step2
            $restaurantsOwnersNotUploadFiles = User::doesntHave('traderRegistrationRequirement')->count();
            $restaurantsLive = 0;
            $totalOrders = 0;
            $pendingOrders = 0;
            $completedOrders = 0;
            $acceptedOrders = 0;
            $cancelledOrders = 0;
            $readyOrders = 0;
            $receivedByResOrders = 0;
            $rejectedOrders = 0;
            $self = $this;
            foreach ($restaurantsAll as $restaurant) {
                $restaurant->run(static function ($tenant) use (
                    &$restaurantsLive,
                    &$totalOrders,
                    $self,
                    &$pendingOrders,
                    &$acceptedOrders,
                    &$completedOrders,
                    &$cancelledOrders,
                    &$readyOrders,
                    &$receivedByResOrders,
                    &$rejectedOrders
                    ) {
                    $setting = Setting::first();
                    if ($setting&&$setting->is_live) {
                        $restaurantsLive++;
                    }
                    $orders = Order::query();
                    $pendingOrders += $self->getOrderStatusCount(clone $orders, 'pending');
                    $acceptedOrders += $self->getOrderStatusCount(clone $orders, 'accepted');
                    $completedOrders += $self->getOrderStatusCount(clone $orders, 'completed');
                    $cancelledOrders += $self->getOrderStatusCount(clone $orders, 'cancelled');
                    $rejectedOrders += $self->getOrderStatusCount(clone $orders, 'rejected');
                    $readyOrders += $self->getOrderStatusCount(clone $orders, 'ready');
                    $receivedByResOrders += $self->getOrderStatusCount(clone $orders, 'receivedByRestaurant');
                    $totalOrders += $orders->count();
                });
            }
            $restaurantsAll = count($restaurantsAll);


            $dailyVisitors = $this->dailyVisitors();
            $monthVisitors = $this->monthlyVisitors();
            return [
                $restaurantsAll,
                $restaurantsOwnersNotUploadFiles,
                $restaurantsLive,
                $totalOrders,
                $acceptedOrders,
                $pendingOrders,
                $completedOrders,
                $cancelledOrders,
                $readyOrders,
                $receivedByResOrders,
                $rejectedOrders,
                $monthVisitors,
                $dailyVisitors
            ];
        });
    }
}
