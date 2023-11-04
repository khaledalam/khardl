<?php

namespace App\Policies;

use App\Models\Tenant;


class TenantPolicy extends Policy
{
    /**
     * The Permission key the Policy corresponds to.
     *
     * @var string
     */
    public static $key = Tenant::class;
    
    
    
    
    
}
