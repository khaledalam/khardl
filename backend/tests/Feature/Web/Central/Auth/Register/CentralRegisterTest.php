<?php

namespace Tests\Feature\Web\Central\Auth\Register;

use App\Actions\CreateTenantAction;
use App\Jobs\SendVerifyEmailJob;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;


class CentralRegisterTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
        Queue::fake();
        Mail::fake();
    }
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
        $data = [
            'status' => 'active',
        ];
        if($options)$data = array_merge($data,$options);
        return User::factory()->create($data);
    }
    private function createRestaurant($user, $domain)
    {
        $tenant =  (new CreateTenantAction)
        (
            user: $user,
            domain: $domain,
            tenantId: '11111-11111-11111-11111-11111'
        );
        return $tenant;
    }
    public function test_register_is_valid(): void
    {
        $data = $this->data();
        $response = $this->postJson('/register', $data);
        $response->assertOk();
        $this->assertDatabaseHas('users',[
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'position' => $data['position'],
            'phone' => $data['phone'],
            'restaurant_name' => $data['restaurant_name'],
        ]);
        $user = User::where('email',$data['email'])->first();
        $this->assertNotNull($user->verification_code);
        $this->assertNotNull($user->roles->first());
        $this->assertSendVerifyEmailJobIsDispatched($user);
    }
    public function assertSendVerifyEmailJobIsDispatched($user)
    {
        Queue::assertPushed(SendVerifyEmailJob::class, function ($job) use ($user) {
            return $job->user->id == $user->id;
        });
    }
    public function test_required_fields()
    {
        $data = $this->data();
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['email'] = '';
        $data['position'] = '';
        $data['password'] = '';
        $data['c_password'] = '';
        $data['phone'] = '';
        $data['restaurant_name'] = '';
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'email',
            'position',
            'password',
            'c_password',
            'phone',
            'restaurant_name',
        ]);
    }
    public function test_string_fields()
    {
        $data = $this->data();
        $data['first_name'] = 1;
        $data['last_name'] = 1;
        $data['email'] = 1;
        $data['position'] = 1;
        $data['password'] = 1;
        $data['restaurant_name'] = 1;
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'email',
            'position',
            'password',
            'restaurant_name',
        ]);
    }
    public function test_same_password_fields()
    {
        $data = $this->data();
        $data['password'] = 'password';
        $data['c_password'] = 'not_same';
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'c_password',
        ]);
    }
    public function test_minimum_fields()
    {
        $data = $this->data();
        $data['first_name'] = 'XX';
        $data['last_name'] = 'XX';
        $data['email'] = 'tt@tt.com';
        $data['position'] = 'XX';
        $data['password'] = 'XXXXX';
        $data['c_password'] = 'XXXXX';
        $data['restaurant_name'] = 'XX';
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'email',
            'position',
            'password',
            'restaurant_name',
        ]);
    }
    public function test_email_field()
    {
        $data = $this->data();
        $data['email'] = 'XXXXXXXXXXXXX';
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'email',
        ]);
    }
    public function test_phone_format_field()
    {
        $data = $this->data();
        $data['phone'] = '012000000000';
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'phone',
        ]);
    }
    public function test_accepted_terms()
    {
        $data = $this->data();
        $data['terms_and_policies'] = false;
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'terms_and_policies',
        ]);
    }
    public function test_restaurant_name_is_already_exist()
    {
        $user = $this->createUser([
            'restaurant_name' => fake()->name
        ]);
        $data = $this->data();
        /* Exist restaurant name in users */
        $data['restaurant_name'] = $user->restaurant_name;
        $response = $this->postJson('/register', $data);
        $response->dump();
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'restaurant_name',
        ]);
        $user->delete();
        /* Exist domain name in domains */
        $domain = CreateTenantAction::generateSubdomain($data['restaurant_name']);
        $this->createRestaurant($this->createUser(),$domain);
        $response = $this->postJson('/register', $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'restaurant_name',
        ]);

    }

}
