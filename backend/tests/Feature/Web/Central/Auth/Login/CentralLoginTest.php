<?php

namespace Tests\Feature\Web\Central\Auth\Login;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;


class CentralLoginTest extends TestCase
{
    private function data()
    {
        return [
            'email' => fake()->email,
            'password' => fake()->password,
            'remember_me' => fake()->boolean
        ];
    }
    public function createUser($options = null) : User
    {
        return User::factory()->create($options);
    }
    public function test_login(): void
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $response = $this->postJson('/login',$data);
        $response->assertOk();

    }


}
