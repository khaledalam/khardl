<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

class Domain extends BaseDomain
{
    protected $casts = [
        
    ];

    public static function booted()
    {
        static::updating(function (self $model) {
           
        });

        static::saved(function (self $model) {
            
        });
    }

    public static function domainFromSubdomain(string $subdomain): string
    {
        return $subdomain . '.' . config('tenancy.central_domains')[0];
    }

    
    public function isSubdomain(): bool
    {
        return ! Str::contains($this->domain, '.');
    }

    /**
     * Get the domain type.
     * Returns 'subdomain' or 'domain'.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return $this->isSubdomain() ? 'subdomain' : 'domain';
    }
}
