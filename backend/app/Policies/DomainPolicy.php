<?php

namespace App\Policies;

use App\Models\Domain;

class DomainPolicy extends Policy
{
    /**
     * The Permission key the Policy corresponds to.
     *
     * @var string
     */
    public static $key = Domain::class;
    
    
}
