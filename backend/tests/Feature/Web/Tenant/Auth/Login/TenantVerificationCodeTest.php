<?php

namespace Tests\Feature\Web\Tenant\Auth\Login;

use App\Models\ROSubscription;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TenantTestCase;


class TenantVerificationCodeTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const path = "/phone";
    public function setUp(): void
    {
        parent::setUp();
        //faking active subscription
        ROSubscription::factory()->create([
            'status' => ROSubscription::ACTIVE
        ]);
        //make restaurant live
        Setting::first()->update(['is_live' => true]);
        $this->user = $this->createUser();
        $this->actingAs($this->user,'web');
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function test_verify_success()
    {
        $response = $this->ownPostJson(self::path."/send-verify");
        $response->assertOk();
        $response->dump();
        $this->assertDatabaseHas('phone_verification_tokens',[
            'user_id' => $this->user->id,
            'created_at' => Carbon::today(),
            'attempts' => 1
        ]);
    }
    public function test_verify_too_many_attempts()
    {
        DB::table('phone_verification_tokens')->insert([
            'user_id' => $this->user->id,
            'created_at' => Carbon::today(),
            'attempts' => 3
        ]);
        $response = $this->ownPostJson(self::path."/send-verify");
        $response->dump();
        $response->assertStatus(403)
        ->assertJson([
            'success' => false,
            'message' => 'Fail',
            "data" =>  "Too many verification attempts. Request a new verification code."
        ]);
    }
}
