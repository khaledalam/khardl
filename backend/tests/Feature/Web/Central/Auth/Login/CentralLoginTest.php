<?php

namespace Tests\Feature\Web\Central\Auth\Login;

use App\Actions\CreateTenantAction;
use App\Jobs\SendVerifyEmailJob;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use App\Models\TraderRequirement;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\TestUtils;


class CentralLoginTest extends TestCase
{
    public function setUp():void
    {
        TestUtils::setTestingCentral();

        parent::setUp();
        Queue::fake();
    }
    private function data()
    {
        return [
            'email' => fake()->email,
            'password' => fake()->password,
            'remember_me' => fake()->boolean
        ];
    }
    public function createUser($options = null): User
    {
        $data = [
            'status' => 'active',
        ];
        if($options)$data = array_merge($data,$options);
        return User::factory()->create($data);
    }
    private function createTradeRegistration($id)
    {
        return TraderRequirement::factory()->create([
            'user_id' => $id
        ]);
    }
    private function createRestaurant($user, $domain)
    {
        $tenant = Tenant::find('140c813f-5794-4e47-8e28-3426ac01f1f8');
        if($tenant)$tenant->delete();
        $tenant =  (new CreateTenantAction)
        (
            user: $user,
            domain: $domain,
        );
        return $tenant;
    }
    private function assertLoginSuccess($response, $email, $status = "completed")
    {
        $response->assertOk();
        $this->assertEquals($email, $response->getOriginalContent()['data']['user']->email);
        $this->assertEquals($status, $response->getOriginalContent()['data']['step2_status']);
    }

    private function assertLoginFailed($response, $statusCode = 403)
    {
        $response->assertStatus($statusCode)
            ->assertJson([
                'success' => false,
                'message' => __('Unauthorized.'),
                'is_loggedin' => false,
            ]);
    }
    public function assertSendVerifyEmailJobIsDispatched($id)
    {
        Queue::assertPushed(SendVerifyEmailJob::class, function ($job) use ($id) {
            return $job->user->id == $id;
        });
    }
    public function test_login(): void
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $response = $this->postJson('/login', $data);
        $this->assertLoginSuccess($response,$data['email'],"completed");
    }
    public function test_email_required()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['email'] = '';
        $response = $this->postJson('/login', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }
    public function test_email_is_email()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $data['email'] = 'NOT_EMAIL';
        $response = $this->postJson('/login', $data);
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
        $response = $this->postJson('/login', $data);
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
        $response = $this->postJson('/login', $data);
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
        $response = $this->postJson('/login', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }
    public function test_user_is_blocked()
    {
        $data = $this->data();
        $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => User::STATUS_BLOCKED
        ]);
        $response = $this->postJson('/login', $data);
        $this->assertLoginFailed($response);
    }
    public function test_login_failed_credentials()
    {
        $data = $this->data();
        $response = $this->postJson('/login', $data);
        $this->assertLoginFailed($response);
    }
    public function test_login_verification_code()
    {
        $data = $this->data();
        $user = $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => RestaurantUser::INACTIVE
        ]);
        $past_code = $user->verification_code;
        $response = $this->postJson('/login', $data);
        $response->assertOk();
        $this->assertLoginSuccess($response,$data['email'],"completed");
        $this->assertEquals(true, $response->getOriginalContent()['is_loggedin']);
        $this->assertEquals($user->verification_code, $past_code);
        $this->assertNotEquals($user->refresh()->verification_code, $past_code);
        $this->assertSendVerifyEmailJobIsDispatched($response->getOriginalContent()['data']['user']->id);
    }
    public function test_login_has_not_trader_reg_incomplete_status()
    {
        $data = $this->data();
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $user = $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $traderRegistration = $this->createTradeRegistration($user->id);
        $user->assignRole($role);
        $response = $this->postJson('/login', $data);
        $response->assertOk();
        $this->assertLoginSuccess($response,$data['email'],"incomplete");
    }
    public function test_login_has_no_restaurant_incomplete_status()
    {
        $data = $this->data();
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $user = $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->assignRole($role);
        $response = $this->postJson('/login', $data);
        $this->assertLoginSuccess($response,$data['email'],"incomplete");
    }

    public function test_login_complete_as_restaurant_owner_status()
    {
        $data = $this->data();
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $user = $this->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->assignRole($role);
        $this->createRestaurant($user, fake()->name);
        $this->createTradeRegistration($user->id);
        $response = $this->postJson('/login', $data);
        $this->assertLoginSuccess($response,$data['email'],"completed");
    }



}
