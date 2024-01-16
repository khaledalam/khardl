<?php

namespace App\Models\Tenant;

use App\Models\CentralTenantSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

class Setting extends Model implements Syncable
{
    use HasFactory, ResourceSyncing;
    protected $table= "settings";
    protected $primaryKey = 'global_id';
    protected $fillable =[
        'is_live',
        'delivery_fee',
        'restaurant_name',
        'loyalty_points_per_order',
        'cashback_per_amount_percentage',
        'global_id'
    ];
    public $timestamps = false;
    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }

    public function getCentralModelName(): string
    {
        return CentralTenantSetting::class;
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
        ];
    }

}
