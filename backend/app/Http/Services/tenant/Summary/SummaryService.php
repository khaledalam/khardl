<?php

namespace App\Http\Services\tenant\Summary;

use App\Models\Tenant\OrderItem;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class SummaryService
{
    public function index()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $branches = Branch::all();
      
        /* $thisMonthRevenues = $this->getTotalPriceThisMonth(clone $orders);
        $lastMonthRevenues = $this->getLastMonthRevenue(clone $orders);
        $dailySales = $this->getDailySales(clone $completedOrders);
        $averageLast7DaysSales = $this->getAverageLast7DaysSales($orders);
        $percentageChange = ($averageLast7DaysSales > 0)
            ? (number_format((($dailySales - $averageLast7DaysSales) / $averageLast7DaysSales) * 100, 2))
            : (($dailySales > 0) ? 100 : 0);
        $percentageChangeForMonth = ($lastMonthRevenues > 0)
            ? (number_format((($thisMonthRevenues - $lastMonthRevenues) / $lastMonthRevenues) * 100, 2))
            : (($thisMonthRevenues > 0) ? 100 : 0); */
        
        [
            $pending ,
            $accepted,
            $completed,
            $cancelled,
            $rejected,
            $ready,
            $receivedByRes,
            $completedOrders,
            $total,
            $dailyRevenues,
            $monthlyRevenues,
            $noOfUsersThisMonth,
            $bestSellingItems,
            $monthVisitors,
            $dailyVisitors 
        ] =
        $this->cacheItems(); 
       
        return view('restaurant.summary', compact(
            'user',
            'branches',
            'total',
            'pending',
            'cancelled',
            'completed',
            'rejected',
            'accepted',
            'ready',
            'receivedByRes',
            'noOfUsersThisMonth',
            'bestSellingItems',
            'dailyRevenues',
            'monthlyRevenues',
            'dailyVisitors',
            'monthVisitors',
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
            ->take(6)
            ->get();
    }
    public function profitDays($count)
    {
        $chart_options = [
            'chart_title' => __('Revenue per day'),
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'aggregate_field' => 'total',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => $count + 1,
            'chart_color' => '194, 218, 8',
            'where_raw' => 'status = "completed"'
        ];
        return new LaravelChart($chart_options);
    }
    public function profitMonths($count)
    {
        $chart_options = [
            'chart_title' => __('Revenue per month'),
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tenant\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'aggregate_field' => 'total',
            'aggregate_function' => 'sum',
            'filter_field' => 'created_at',
            'filter_days' => $count * 30,
            'chart_color' => '0, 158, 247',
            'where_raw' => 'status = "completed"'
        ];
        return new LaravelChart($chart_options);
    }
    public function dailyRevenues()
    {
        return $this->profitDays(7);
    }
    public function monthlyRevenues()
    {
        return $this->profitMonths(6);
    }
    public function cacheItems(){
        $cacheKey = 'cache_RO_Summary_Page';
        return Cache::remember($cacheKey, config("application.$cacheKey", 24 * 60 * 60), function () {
            $orders = Order::query();
            $pending = $this->getOrderStatusCount(clone $orders, 'pending');
            $accepted = $this->getOrderStatusCount(clone $orders, 'accepted');
            $completed = $this->getOrderStatusCount(clone $orders, 'completed');
            $cancelled = $this->getOrderStatusCount(clone $orders, 'cancelled');
            $rejected = $this->getOrderStatusCount(clone $orders, 'rejected');
            $ready = $this->getOrderStatusCount(clone $orders, 'ready');
            $receivedByRes = $this->getOrderStatusCount(clone $orders, 'receivedByRestaurant');
            $allOrders = $orders->get();
            $total = $allOrders->count();
            $dailyRevenues = $this->dailyRevenues();
            $monthlyRevenues = $this->monthlyRevenues();
            $noOfUsersThisMonth = $this->getNumberOfUsersThisMonth();
            $bestSellingItems = $this->bestSellingItems();
            $monthVisitors = $this->monthlyVisitors();
            $dailyVisitors = $this->dailyVisitors();

            return [
                $pending,
                $accepted,
                $completed,
                $cancelled,
                $rejected,
                $ready,
                $receivedByRes,
                $allOrders->toArray(),
                $total,
                $dailyRevenues,
                $monthlyRevenues,
                $noOfUsersThisMonth,
                $bestSellingItems,
                $monthVisitors,
                $dailyVisitors,
            ];
        });
    }
    public function dailyVisitors()
    {
        return $this->getDaily(7);
    }
    public function monthlyVisitors()
    {
        return $this->getMonthly(6);
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
            'filter_days' => 7,
            'chart_color' => '194, 218, 8',
        ];
        return new LaravelChart($chart_options);
    }
    public function getMonthly($count)
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
            'filter_days' => $count * 30,
            'chart_color' => '0, 158, 247',
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

        return RestaurantUser::Customers()->whereYear('created_at', $currentDate['year'])
            ->whereMonth('created_at', $currentDate['month'])
            ->count();
    }
    public function getLastMonthRevenue($orders)
    {
        $currentDate = Carbon::now();
        $lastMonthDate = $currentDate->subMonth();

        return $orders
            ->completed()
            ->whereYear('created_at', $lastMonthDate->year)
            ->whereMonth('created_at', $lastMonthDate->month)
            ->sum('total');
    }
    public function getTotalPriceThisMonth($orders)
    {
        $currentDate = $this->getCurrentMonthAndYear();
        return $orders
            ->completed()
            ->whereYear('created_at', $currentDate['year'])
            ->whereMonth('created_at', $currentDate['month'])
            ->sum('total');
    }
    public function getOrderStatusCount($orders, $scope)
    {
        return $orders->$scope()->count();
    }

    private function getDailySales($completed)
    {
        return $completed->whereDate('created_at', Carbon::today())->avg('total') ?? 0;
    }

    public function getAverageLast7DaysSales($orders)
    {
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->subDays(1)->endOfDay();

        return $orders
            ->completed()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->avg('total') ?? 0;
    }
}
