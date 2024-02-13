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
        $this->assertEquals($data['email'], $response->getOriginalContent()['data']['user']->email);
        $this->assertEquals("completed", $response->getOriginalContent()['data']['step2_status']);
    }
    public function test_email_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['email'] = '';
        $response = $this->postJson('/login',$data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }
    public function test_email_is_email_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['email'] = 'NOT_EMAIL';
        $response = $this->postJson('/login',$data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }
    public function test_email_is_min_10_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['email'] = 'tes@t.com';
        $response = $this->postJson('/login',$data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }
    public function test_password_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['password'] = '';
        $response = $this->postJson('/login',$data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }
    public function test_password_min_6_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['password'] = 'PASS';
        $response = $this->postJson('/login',$data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }


}
