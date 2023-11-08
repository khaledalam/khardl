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
    public function run($name = 'first')
    {
        $user = User::first();
        (new CreateTenantAction)
        (
            data: [
                'email'=>$name.'.'.config('tenancy.central_domains')[0]."@admin.com",
                "first_name" => $user->first_name,
                "last_name" =>$user->last_name,
                "password" => $user->password,
                "trial_ends_at" => now()->addDays(30),
            ],
            domain: $name,
            user: $user
        );
       
    }
}