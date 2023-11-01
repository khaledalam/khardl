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
        User $user,
        int $subscription_id = null): Tenant
    {
        $tenant = Tenant::create($data + [
            'user_id'=> $user->id,
            'ready' => true,
            'trial_ends_at' => now()->addDays(30),
            'subscription_id' => $subscription_id,
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
