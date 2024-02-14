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
        $subscription = ROSubscription::factory()->create();
        dd($subscription);
        Setting::first()->update(['is_live' => true]);
        $this->user = $this->createUser();
        $this->actingAs($this->user,'web');
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function test()
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
            'is_loggedin' => false,
            "data" =>  "Too many verification attempts. Request a new verification code."
        ]);
    }
}
