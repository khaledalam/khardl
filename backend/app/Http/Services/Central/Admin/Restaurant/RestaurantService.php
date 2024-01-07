<?php

namespace App\Http\Services\Central\Admin\Restaurant;

use App\Models\Tenant;
use App\Models\Tenant\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\tenant\Restaurant\RestaurantService as TenantRestaurantService;


class RestaurantService
{
    public function index(Request $request)
    {
        $query = Tenant::query()->with('primary_domain')
            ->whenSearch($request['search'] ?? null);
        $restaurants = $query->get();

        $tenants = [];
        if (isset($request['live']) && ($request['live'] == 1 || $request['live'] == 0)) {
            foreach ($restaurants as $restaurant) {
                if (($restaurant->is_live() && $request['live'] == 0) || (!$restaurant->is_live() && $request['live'] == 1)) {
                    $query->where('id', '!=', $restaurant->id);
                }
            }
        }
        if (isset($request['order_by']) && $request['order_by'] == 'highest_orders') {
            $restaurants = $query->paginate(config('application.perPage') ?? 20)->through(function ($tenant) {
                $tenant->run(function ($res) {
                    $res->orders_count = $res->completed_orders()->count();
                });
                return $tenant;
            })->sortByDesc('orders_count')->customPaginate(config('application.perPage') ?? 20);/* TODO: Paginate after sorting */

        }elseif (isset($request['order_by']) && $request['order_by'] == 'highest_customers') {
            $restaurants = $query->paginate(config('application.perPage') ?? 20)->through(function ($tenant) {
                $tenant->run(function ($res) {
                    $res->customers_count = $res->allCustomers()->count();
                });
                return $tenant;
            })->sortByDesc('customers_count')->customPaginate(config('application.perPage') ?? 20);/* TODO: Paginate after sorting */

        } else {
            $restaurants = $query->paginate(config('application.perPage') ?? 20);
        }
        $user = Auth::user();

        return view('admin.restaraunts', compact('restaurants', 'user'));
    }
    public function show(Tenant $tenant)
    {
        $restaurant = $tenant;
        [
            $logo,
            $is_live,
            $orders,
            $customers,
            $dailyEarning,
            $totalOrders,
            $dailyOrders,
            $last7DaysAverageEarning,
            $last7DaysAverageOrders,
            $pendingOrders,
            $completedOrders,
            $acceptedOrders,
            $cancelledOrders,
            $salesThisMonth,
            $profitDays,
            $profitMonths
        ] = $this->getRestaurantData($restaurant);

        $owner = $restaurant->user;
        $user = Auth::user();
        $compareEarningResult = $dailyEarning > $last7DaysAverageEarning ? 'higher' : 'lower';
        $compareOrderResult = $dailyOrders > $last7DaysAverageOrders ? 'higher' : 'lower';
        return view(
            'admin.Restaurants.Layout.view',
            compact(
                'restaurant',
                'user',
                'logo',
                'is_live',
                'owner',
                'orders',
                'customers',
                'dailyEarning',
                'totalOrders',
                'dailyOrders',
                'compareEarningResult',
                'compareOrderResult',
                'pendingOrders',
                'completedOrders',
                'acceptedOrders',
                'cancelledOrders',
                'salesThisMonth',
                'profitDays',
                'profitMonths',
            )
        );
    }

    protected function getRestaurantData(Tenant $restaurant)
    {
        $data = $restaurant->run(function ($restaurant) {
            $tenantRestaurantService = new TenantRestaurantService();
            $info = $restaurant->info(false);
            $orders = $restaurant->orders(false);
            $dailyEarning = $this->getDailyEarning(clone $orders);
            $totalOrders = $this->getTotalOrders(clone $orders);
            $dailyOrders = $this->getDailyOrders(clone $orders);
            $last7DaysAverageEarning = $tenantRestaurantService->getAverageLast7DaysSales(clone $orders);
            $last7DaysAverageOrders = $this->getLast7DaysAverageOrders(clone $orders);
            $pendingOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'pending');
            $acceptedOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'accepted');
            $completedOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'completed');
            $cancelledOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'cancelled');
            $salesThisMonth = $tenantRestaurantService->getTotalPriceThisMonth(clone $orders);
            $profitDays = $tenantRestaurantService->profitDays(7);
            $profitMonths = $tenantRestaurantService->profitMonths(12);
            return [
                $info['logo'],
                $info['is_live'],
                $orders->recent()->paginate(config('application.perPage')),
                $restaurant->customers(false),
                $dailyEarning,
                $totalOrders,
                $dailyOrders,
                $last7DaysAverageEarning,
                $last7DaysAverageOrders,
                $pendingOrders,
                $completedOrders,
                $acceptedOrders,
                $cancelledOrders,
                $salesThisMonth,
                $profitDays,
                $profitMonths
            ];
        });

        return $data;
    }

    private function getLast7DaysAverageOrders($orders)
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->subDays(1)->endOfDay();
        $countLast7DaysOrders = $orders
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'));
        $totalCount = $countLast7DaysOrders->get()->count();
        $daysInWork = $countLast7DaysOrders->groupBy('day')->get()->count();
        $avg = ($daysInWork > 0) ? $totalCount / $daysInWork : 0;
        return $avg;
    }

    private function getDailyEarning($orders)
    {
        return $orders->completed()
            ->whereDate('created_at', Carbon::today())
            ->sum('total');
    }

    private function getTotalOrders($orders)
    {
        return $orders->count();
    }

    private function getDailyOrders($orders)
    {
        return $orders->whereDate('created_at', Carbon::today())
            ->count();
    }
}
