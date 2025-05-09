<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tenant\Setting;
use App\Http\Resources\API\Tenant\OrderResource;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\RestaurantUser;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Exception;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'email',
            'user_id',
            'restaurant_name'
        ];
    }
    protected $appends = ['url'];
    public function primary_domain()
    {
        return $this->hasOne(Domain::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function central_tenant_setting()
    {
        return $this->belongsToMany(
            CentralTenantSetting::class,
            'pivot_settings',
            'tenant_id',
            'global_setting_id',
            'id',
            'global_id'
        );
    }
    /* Start getter and setters */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getTotalEarningAttribute()
    {
        return $this->run(function () {
            $total = Order::completed()->sum('total');
            return [
                'number_formatted' => getAmount((float)$total),
                'number' => $total
            ];
        });
    }
    public function getTotalOrdersAttribute()
    {
        return $this->run(function () {
            $count =  Order::completed()->count();
            return [
                'number_formatted' => getAmount((float)$count),
                'number' => $count
            ];
        });
    }
    public function getUrlAttribute(){
        return tenant_route($this->primary_domain->domain .'.'.config("tenancy.central_domains")[0], 'home', [], true) . '/api';
    }
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
    /* Start getter and setters */
    public function route($route, $parameters = [], $absolute = true)
    {
        $domain = $this->primary_domain->domain;
        $parts = explode('.', $domain);
        if (count($parts) === 1) { // If subdomain
            $domain = Domain::domainFromSubdomain($domain);
        }

        return tenant_route($domain, $route, $parameters, $absolute);
    }

    public function impersonationUrl($user_id,$route = 'home'): string
    {
        $token = tenancy()->impersonate($this, $user_id, $this->route($route), 'web')->token;
        return $this->route('impersonate', ['token' => $token]);
    }

    public function is_live($run_on_tenant = true): bool
    {
        $settingQuery = function () {
            return Setting::first()->is_live;
        };
        return $run_on_tenant ? $this->run($settingQuery) : $settingQuery();
    }
    public function activeRestaurant($run_on_tenant = true)
    {
        $settingQuery = function () {
            $setting = Setting::first();
            $setting->update([
                'is_live' => 1
            ]);
        };
        return $run_on_tenant ? $this->run($settingQuery) : $settingQuery();

    }
    public function logo($run_on_tenant = true)
    {

        $styleQuery = function () {
            return RestaurantStyle::first()->logo;
        };
        return $run_on_tenant ? $this->run($styleQuery) : $styleQuery();

    }
    public function orders($run_on_tenant = true)
    {
        $orderQuery = function () {
            return Order::with(['payment_method:id,name', 'branch:id,name']);
        };
        return $run_on_tenant ? $this->run($orderQuery) : $orderQuery();
    }
    public function completed_orders($run_on_tenant = true)
    {
        $orderQuery = function () {
            return Order::completed();
        };
        return $run_on_tenant ? $this->run($orderQuery) : $orderQuery();
    }
    public function revenues($run_on_tenant = true)
    {
        $orderQuery = function () {
            return Order::completed()->sum('total');
        };
        return $run_on_tenant ? $this->run($orderQuery) : $orderQuery();
    }
    public function visitors($run_on_tenant = true)
    {
        $orderQuery = function () {
            return Visitor::all();
        };
        return $run_on_tenant ? $this->run($orderQuery) : $orderQuery();
    }
    public function customerApp($run_on_tenant = true)
    {
        $query = function () {
            return ROCustomerAppSub::first();
        };
        return $run_on_tenant ? $this->run($query) : $query();
    }
    public function allCustomers($run_on_tenant = true)
    {
        $customerQuery = function () {
            return RestaurantUser::customers()->orderBy('created_at','DESC');
        };
        return $run_on_tenant ? $this->run($customerQuery) : $customerQuery();
    }
    public function customers($run_on_tenant = true)
    {
        $customerQuery = function () {
            return RestaurantUser::customers()->orderBy('created_at','DESC')->paginate(20);
        };
        return $run_on_tenant ? $this->run($customerQuery) : $customerQuery();
    }
    public function info($run_on_tenant = true){
        $is_live = $this->is_live($run_on_tenant);
        return ['is_live'=>$is_live,'logo'=>$this->logo($run_on_tenant) ?? null];
    }
    /* Start Scope */
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q->where('restaurant_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhereHas('primary_domain', static function ($query1) use ($search) {
                $query1->where('domain', 'like', '%' . $search . '%');
            })->orWhere(function ($query2) use ($search) {
                try {
                    $query2->whereJsonContains('data->mapper_hash', $search)
                    ->orWhereJsonContains('data->first_name', $search)
                    ->orWhereJsonContains('data->last_name', $search);
                } catch (\Exception $e) {
                    \Sentry\captureException($e);
                }
            });
        });
    }
    public function scopeWhenLive($query,$isLive)
    {
        return $query->when($isLive != null, function ($q) use ($isLive) {
            return $q->where('is_live', $isLive);
        });
    }
    /* End Scope */
}
