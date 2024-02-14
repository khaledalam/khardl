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
    public function test_register_success(): void
    {
        $data = [
            'first_name' => fake()->name,
            'last_name' => fake()->name,
            'phone' => fake()->numerify('966#########'),
            'email' => fake()->email
        ];
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

    }
}
