<?php

namespace App\Models;
use App\Models\Tenant;
use App\Models\Tenant\Setting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Contracts\SyncMaster;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Database\Models\TenantPivot;

class CentralTenantSetting extends Model implements SyncMaster
{
    use HasFactory, CentralConnection, ResourceSyncing;

    public $table = 'central_tenant_settings';

    protected $guarded  =[];

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'pivot_settings', 'global_setting_id', 'tenant_id', 'global_id')
            ->using(TenantPivot::class);
    }

    public function getTenantModelName(): string
    {
        return Setting::class;
    }

    public function getCentralModelName(): string
    {
        return static::class;
    }

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }
    public function getSyncedAttributeNames(): array
    {
        return [
            'is_live',
            'delivery_fee',
            'restaurant_name',
            'loyalty_points',
            'loyalty_point_price',
            'cashback_threshold',
            'cashback_percentage',
            'lead_id',
            'merchant_id',
            'lead_response',
            'limit_delivery_company',
        ];
    }
}
