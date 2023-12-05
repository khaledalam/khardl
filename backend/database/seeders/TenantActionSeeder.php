<?php

namespace Database\Seeders;


use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Actions\CreateTenantAction;
use App\Models\User;

class TenantActionSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run($name = 'first',$id )
    {
        $user = User::find($id);
        (new CreateTenantAction)
        (
            domain: $name,
            user: $user
        );
       
    }
}