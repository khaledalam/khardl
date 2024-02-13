<?php

namespace Tests\Feature\Web\Central\Auth\Login;

use App\Actions\CreateTenantAction;
use App\Models\User;
use Tests\TestCase;


class CentralRegisterTest extends TestCase
{
    private function data()
    {
        return [
            'first_name' => fake()->name,
            'last_name' => fake()->name,
            'email' => fake()->email,
            'position' =>fake()->name,
            'password' => $password = fake()->password,
            'c_password' => $password,
            'phone' => fake()->numerify('966#########'),
            'terms_and_policies' => true,
            'restaurant_name' => fake()->name,
        ];
    }
    public function createUser($options = null): User
    {
        return User::factory()->create($options);
    }
    private function createRestaurant($user, $domain)
    {
        $tenant =  (new CreateTenantAction)
        (
            user: $user,
            domain: $domain
        );
        return $tenant;
    }
    public function test_register(): void
    {
        $data = $this->data();
        $response = $this->postJson('/register', $data);
        $response->dump();
        $response->assertOk();
    }

}
