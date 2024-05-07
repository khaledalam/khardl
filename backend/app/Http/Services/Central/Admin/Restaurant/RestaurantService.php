<?php

namespace App\Http\Services\Central\Admin\Restaurant;

use App\Http\Services\tenant\Summary\SummaryService;
use App\Models\Tenant;
use App\Models\Tenant\DeliveryCompany;
use App\Models\Tenant\Setting;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ROCustomerAppSub;
use App\Models\ROSubscription;
use App\Models\Tenant\RestaurantUser;

class RestaurantService
{
    public function index(Request $request)
    {
        $query = Tenant::query()->with('primary_domain')
            ->whenSearch($request['search'] ?? null);
        $restaurants = $query->orderBy('created_at', 'DESC')->get();
        $totalRestaurantsCount = count($restaurants);

        // TODO @todo make sub active or not tag with search
        $tenants = [];
        if (isset($request['live']) && ($request['live'] == 1 || $request['live'] == 0)) {
            foreach ($restaurants as $restaurant) {
                if (($restaurant->is_live() && $request['live'] == 0) || (!$restaurant->is_live() && $request['live'] == 1)) {
                    $query->where('id', '!=', $restaurant->id);
                }
            }
        }
        if (isset($request['order_by']) && $request['order_by'] == 'highest_orders') {
            $results = $query->get()->map(function ($tenant) {
                $tenant->run(function ($res) {
                    $res->orders_count = $res->completed_orders()->count();
                });
                return $tenant;
            });

            $restaurants = $results->sortByDescAndPaginate('orders_count', config('application.perPage'));

        } elseif (isset($request['order_by']) && $request['order_by'] == 'highest_customers') {
            $results = $query->get()->map(function ($tenant) {
                $tenant->run(function ($res) {
                    $res->customers_count = $res->allCustomers()->count();
                });
                return $tenant;
            });

            $restaurants = $results->sortByDescAndPaginate('customers_count', config('application.perPage'));
        } else {
            $restaurants = $query->paginate(config('application.perPage'));
        }
        $user = Auth::user();

        return view('admin.restaurants', compact('restaurants', 'user', 'totalRestaurantsCount'));
    }
    public function appRequested($request)
    {
        $query = Tenant::query()->with('primary_domain')
            ->whenSearch($request['search'] ?? null);
        $restaurants = $query->orderBy('created_at', 'DESC')->get();
        $totalRestaurantsCount = count($restaurants);

        // TODO @todo make sub active or not tag with search
        $tenants = [];

        $restaurants = $query->paginate(config('application.perPage') ?? 20);
        $user = Auth::user();

        return view('admin.app-requested-restaurants', compact('restaurants', 'user', 'totalRestaurantsCount'));
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
            $rejectedOrders,
            $readyOrders,
            $receivedByResOrders,
            $salesThisMonth,
            $profitDays,
            $profitMonths,
            $yeswa,
            $cervo,
            $streetline,
            $subscription,
            $setting,
            $RO,
            $restaurant_name,
            $customer_app
        ] = $this->getRestaurantData($restaurant);

        $owner = $restaurant->user;
        $user = Auth::user();
        $traderRegistrationRequirement = $restaurant->user->traderRegistrationRequirement;
        $compareEarningResult = $dailyEarning > $last7DaysAverageEarning ? 'higher' : 'lower';
        $compareOrderResult = $dailyOrders > $last7DaysAverageOrders ? 'higher' : 'lower';

        $path = storage_path("app/private/user_files/{$restaurant->user?->id}");
        if (!file_exists($path)) {
            $filesCount = 0;
        } else {
            $filesCount = count(\File::allFiles($path));
        }


        return view(
            'admin.Restaurants.Layout.view',
            compact(
                'restaurant',
                'user',
                'filesCount',
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
                'rejectedOrders',
                'readyOrders',
                'receivedByResOrders',
                'salesThisMonth',
                'profitDays',
                'profitMonths',
                'yeswa',
                'cervo',
                'streetline',
                'subscription',
                'setting',
                'traderRegistrationRequirement',
                'RO',
                'restaurant_name',
                'customer_app'
            )
        );
    }

    protected function getRestaurantData(Tenant $restaurant)
    {
        $data = $restaurant->run(function ($restaurant) {

            $tenantRestaurantService = new SummaryService();
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
            $rejectedOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'rejected');
            $readyOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'ready');
            $receivedByResOrders = $tenantRestaurantService->getOrderStatusCount(clone $orders, 'receivedByRestaurant');
            $salesThisMonth = $tenantRestaurantService->getTotalPriceThisMonth(clone $orders);
            $profitDays = $tenantRestaurantService->profitDays(7);
            $profitMonths = $tenantRestaurantService->profitMonths(12);
            $yeswa = DeliveryCompany::where("module", class_basename(Yeswa::class))->first();
            $cervo = DeliveryCompany::where("module", class_basename(Cervo::class))->first();
            $streetline = DeliveryCompany::where("module", class_basename(StreetLine::class))->first();
            $subscription = ROSubscription::first();
            $setting = Setting::first();
            $RO = RestaurantUser::first();
            $restaurant_name = $setting->restaurant_name;
            $customer_app = ROCustomerAppSub::first();

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
                $rejectedOrders,
                $readyOrders,
                $receivedByResOrders,
                $salesThisMonth,
                $profitDays,
                $profitMonths,
                $yeswa,
                $cervo,
                $streetline,
                $subscription,
                $setting,
                $RO,
                $restaurant_name,
                $customer_app
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
