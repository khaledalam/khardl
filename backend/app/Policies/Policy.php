<?php
namespace App\Policies;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;
    public static $key = '';
    public function before($user, $ability)
    {
        // TODO handle policies namespace for tenant and central
        return true; // for now
        if ($user->isAdmin()) {
            return true;
        }
        static::$key = $this->getPermissionName(static::$key);
    }
    public function create(User $user)
    {
        if ($user->hasPermissionTo('manage ' . static::$key)) {
            return true;
        }
        return false;
    }
    public function delete(User $user, $model)
    {
        if ($user->hasPermissionTo('manage ' . static::$key)) {
            return true;
        }

        if ($user->hasPermissionTo('manage own ' . static::$key)) {
            return $user->id == $model->user_id;
        }

        return false;
    }
    public function forceDelete(User $user, $model)
    {
        if ($user->hasPermissionTo('manage ' . static::$key)) {
            return true;
        }

        return false;
    }
    public function restore(User $user, $model)
    {
        if ($user->hasPermissionTo('manage ' . static::$key)) {
            return true;
        }

        if ($user->hasPermissionTo('manage own ' . static::$key)) {
            return $user->id == $model->user_id;
        }

        return false;
    }

   
    public function update(User $user, $model)
    {
        if ($user->hasPermissionTo('manage ' . static::$key)) {
            return true;
        }

        if ($user->hasPermissionTo('manage own ' . static::$key)) {
            return $user->id == $model->user_id;
        }

        return false;
    }

    public function view(User $user, $model)
    {
        if ($user->hasPermissionTo('view ' . static::$key)) {
            return true;
        }
        
        if ($user->hasPermissionTo('view own ' . static::$key)) {
            return $user->id == $model->user_id;
        }

        return false;
    }

    
   
    public function viewAny(User $user)
    {
        return true;
        return $user->hasAnyPermission(['view own ' . static::$key,'view ' . static::$key]);
    }
     /**
     * Get permission name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getPermissionName($class)
    {
        return Str::plural(Str::snake(class_basename($class), ' '));
    }
}
