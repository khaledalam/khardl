<?php

namespace Tests\Feature\Web\Tenant\Auth\Register;
use App\Models\ROSubscription;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Setting;
use Carbon\Carbon;
use Tests\TenantTestCase;



class TenantRegisterTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const path = "/register";
    public function setUp(): void
    {
        parent::setUp();
        //faking active subscription
        ROSubscription::factory()->create([
            'status' => ROSubscription::ACTIVE
        ]);
        //make restaurant live
        Setting::first()->update(['is_live' => true]);
    }
    private function data()
    {
        return [
            'first_name' => fake()->name,
            'last_name' => fake()->name,
            'phone' => fake()->numerify('966#########'),
            'email' => fake()->email
        ];
    }
    public function test_register_success(): void
    {
        $data = $this->data();
        $response = $this->ownPostJson(self::path, $data);
        $this->assertDatabaseHas('users',[
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status' => RestaurantUser::INACTIVE
        ]);
        $user = RestaurantUser::where('email',$data['email'])->first();
        $this->assertDatabaseHas('phone_verification_tokens',[
            'user_id' => $user->id,
            'created_at' => Carbon::today(),
            'attempts' => 1
        ]);
        $this->assertNotNull($user->tap_customer_id);//testing tap created account
    }
    public function test_register_required_fields(): void
    {
        $data = $this->data();
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['phone'] = '';
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'phone',
        ]);
    }
    public function test_register_string_fields(): void
    {
        $data = $this->data();
        $data['first_name'] = 1;
        $data['last_name'] = 1;
        $data['email'] = 1;
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'email',
        ]);
    }
    public function test_minimum_fields()
    {
        $data = $this->data();
        $data['first_name'] = 'XX';
        $data['last_name'] = 'XX';
        $data['email'] = 'tt@tt.com';
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'first_name',
            'last_name',
            'email',
        ]);
    }
    public function test_email_field()
    {
        $data = $this->data();
        $data['email'] = 'XXXXXXXXXXXXX';
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'email',
        ]);
    }
    public function test_phone_format_field()
    {
        $data = $this->data();
        $data['phone'] = '012000000000';
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'phone',
        ]);
    }
    public function test_phone_and_email_unique_field()
    {
        $data = $this->data();
        RestaurantUser::factory()->create([
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);
        $response = $this->ownPostJson(self::path, $data);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'email',
        ]);
    }
}
