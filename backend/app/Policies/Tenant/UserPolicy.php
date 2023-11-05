<?php

namespace App\Policies\Tenant;

use App\Models\Review;
use App\Policies\Policy;
use App\Models\Tenant\User;
use App\Models\Specialization;

class UserPolicy extends Policy
{
    /**
     * The Permission key the Policy corresponds to.
     *
     * @var string
     */
    public static $key = User::class;
    
    
    
}
