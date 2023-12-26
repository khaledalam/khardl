<?php

namespace App\Http\Services\tenant\Restaurant;

use App\Models\Tenant\OrderItem;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\DB;
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
        $totalPriceThisMonth = $this->getTotalPriceThisMonth(clone $completedOrders);
        $total = $allOrders->count();
        $ordersStatuses = $allOrders->groupBy('status');
        $pending = $this->getOrderStatusCount($ordersStatuses, Order::PENDING);
        $accepted = $this->getOrderStatusCount($ordersStatuses, Order::ACCEPTED);
        $completed = $this->getOrderStatusCount($ordersStatuses, Order::COMPLETED);
        $cancelled = $this->getOrderStatusCount($ordersStatuses, Order::CANCELLED);
        $dailySales = $this->getDailySales(clone $completedOrders);
        $averageLast7DaysSales = $this->getAverageLast7DaysSales($completedOrders);
        $profitLast7Days = $this->profitLast7Days();
        $profitLast4Months = $this->profitLast4Months();
        $percentageChange = ($averageLast7DaysSales > 0)
            ? (number_format((($dailySales - $averageLast7DaysSales) / $averageLast7DaysSales) * 100, 2))
            : (($dailySales > 0) ? 100 : 0);

        $dailySales = number_format($dailySales, 2);
        $noOfUsersThisMonth = $this->getNumberOfUsersThisMonth();
        $bestSellingItems = $this->bestSellingItems();
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
            'profitLast7Days',
            'totalPriceThisMonth',
            'profitLast4Months',
            'bestSellingItems'
        ));
    }
    private function bestSellingItems()
    {
        return OrderItem::with('item')
            ->whereHas('order', function ($query) {
                $query->whereDate('created_at', '>=', now()->subDays(30));
            })
            ->select('item_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('item_id')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get();
    }
    private function profitLast7Days()
    {
        $chart_options = [
            'chart_title' => 'Profit per day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'aggregate_field' => 'total',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => 8,
            'chart_color' => '194, 218, 8',
            'where_raw' => 'status = "completed"'
        ];
        return new LaravelChart($chart_options);
    }
    private function profitLast4Months()
    {
        $chart_options = [
            'chart_title' => 'Profit per month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'aggregate_field' => 'total',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => 4 * 30, //Last 4 months
            'chart_color' => '0, 158, 247',
            'where_raw' => 'status = "completed"'
        ];
        return new LaravelChart($chart_options);
    }
    private function getCurrentMonthAndYear()
    {
        return [
            'month' => Carbon::now()->format('m'),
            'year' => Carbon::now()->format('Y'),
        ];
    }

    private function getNumberOfUsersThisMonth()
    {
        $currentDate = $this->getCurrentMonthAndYear();

        return User::whereYear('created_at', $currentDate['year'])
            ->whereMonth('created_at', $currentDate['month'])
            ->count();
    }

    private function getTotalPriceThisMonth($completedOrders)
    {
        $currentDate = $this->getCurrentMonthAndYear();

        return $completedOrders->whereYear('created_at', $currentDate['year'])
            ->whereMonth('created_at', $currentDate['month'])
            ->sum('total');
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
