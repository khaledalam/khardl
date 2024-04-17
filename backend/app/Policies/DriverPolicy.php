<?php

namespace App\Policies;

use App\Models\Tenant\RestaurantUser;
use Illuminate\Auth\Access\Response;

class DriverPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(RestaurantUser $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(RestaurantUser $user, RestaurantUser $driver): bool
    {
        if($user->isRestaurantOwner())return true;
        return $user->isWorker() && $user->branch_id == $driver->branch_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(RestaurantUser $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(RestaurantUser $user, RestaurantUser $driver): bool
    {
        if($user->isRestaurantOwner())return true;
        return $user->isWorker() && $user->branch_id == $driver->branch_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(RestaurantUser $user, RestaurantUser $driver): bool
    {
        if($user->isRestaurantOwner())return true;
        return $user->isWorker() && $user->branch_id == $driver->branch_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(RestaurantUser $user, RestaurantUser $driver): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(RestaurantUser $user, RestaurantUser $driver): bool
    {
        //
    }
}
