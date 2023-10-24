<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class BranchRole extends SpatieRole
{
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'roles', 'role_id', 'branch_id');
    }
}
