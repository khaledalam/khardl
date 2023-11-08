<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Tenant;
use Database\Factories\Tenant\UserFactory;

class CreateTenantAction
{
    public function __invoke(
        array $data,
        string $domain,
        User $user): Tenant
    {
        $tenant = Tenant::create($data + [
            'user_id'=> $user->id,
            'ready' => true,
            'trial_ends_at' => now()->addDays(30),
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
