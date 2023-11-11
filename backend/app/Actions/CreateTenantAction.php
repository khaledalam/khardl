<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Tenant;
use Database\Factories\Tenant\UserFactory;

class CreateTenantAction
{
    public function __invoke(
        string $domain,
        User $user): Tenant
    {
        $tenant = Tenant::create([
            'user_id'=> $user->id,
            'ready' => true,
            'email'=>'admin'.'@'.$domain.'.com',
            "first_name" => $user->first_name,
            "last_name" =>$user->last_name,
            "trial_ends_at" => now()->addDays(30),
            "password" => $user->password,
        ]);

        $tenant->createDomain([
            'domain' => $domain,
        ]);

    
        $tenant->run(function ($tenant) {
            // run actions through tenant scope

        });

        return $tenant;
    }
}
