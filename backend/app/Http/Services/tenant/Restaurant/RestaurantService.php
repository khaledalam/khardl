<?php

namespace App\Http\Services\tenant\Restaurant;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class RestaurantService
{
    public function index()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $branches = Branch::all();
        $orders = Order::query();
        $allOrders = $orders->get();
        $completedOrders = $orders->completed();
        $total = $allOrders->count();
        $ordersStatuses = $allOrders->groupBy('status');
        $pending = $this->getOrderStatusCount($ordersStatuses, Order::PENDING);
        $accepted = $this->getOrderStatusCount($ordersStatuses, Order::ACCEPTED);
        $completed = $this->getOrderStatusCount($ordersStatuses, Order::COMPLETED);
        $cancelled = $this->getOrderStatusCount($ordersStatuses, Order::CANCELLED);
        $dailySales = $this->getDailySales(clone $completedOrders);
        $averageLast7DaysSales = $this->getAverageLast7DaysSales($completedOrders);
        $chart1 = $this->chart();
        $percentageChange = ($averageLast7DaysSales > 0)
            ? (number_format((($dailySales - $averageLast7DaysSales) / $averageLast7DaysSales) * 100, 2))
            : (($dailySales > 0) ? 100 : 0);

        $dailySales = number_format($dailySales, 2);
        $noOfUsersThisMonth = $this->getNumberOfUsersThisMonth();

        return view('restaurant.summary', compact(
            'user',
            'branches',
            'total',
            'pending',
            'cancelled',
            'completed',
            'accepted',
            'dailySales',
            'percentageChange',
            'noOfUsersThisMonth',
            'chart1'
        ));
    }
    private function chart(){
        $chart_options = [
            'chart_title' => 'Completed orders by week',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'aggregate_field' => 'total',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days'           => 8,
            /* 'where_raw' => 'status = "completed"' */
        ];
        return new LaravelChart($chart_options);
    }
    private function getNumberOfUsersThisMonth(){
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        return User::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->count();
    }
    private function getOrderStatusCount($ordersStatuses, $status)
    {
        return $ordersStatuses->has($status) ? $ordersStatuses[$status]->count() : 0;
    }

    private function getDailySales($completed)
    {
        return $completed->whereDate('created_at', Carbon::today())->avg('total') ?? 0;
    }

    private function getAverageLast7DaysSales($completedOrders)
    {
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->subDays(1)->endOfDay();

        return $completedOrders
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->avg('total') ?? 0;
    }
}
