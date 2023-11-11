<?php

namespace App\Models;

use App\Models\User;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
    protected $casts = [
        'trial_ends_at' => 'datetime',

    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'email',
            'user_id'
        ];
    }
    public function primary_domain()
    {
        return $this->hasOne(Domain::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function route($route, $parameters = [], $absolute = true)
    {
        $domain = $this->primary_domain->domain;
        $parts = explode('.', $domain);
        if (count($parts) === 1) { // If subdomain
            $domain = Domain::domainFromSubdomain($domain);
        }

        return tenant_route($domain, $route, $parameters, $absolute);
    }

    public function impersonationUrl($user_id): string
    {
        $token = tenancy()->impersonate($this, $user_id, $this->route('tenant.home'), 'web')->token;

        return $this->route('tenant.impersonate', ['token' => $token]);
    }

}