<?php

namespace Tests\Feature\Web\Central\Auth\Login;

use App\Jobs\SendVerifyEmailJob;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;


class VerificationCodeTest extends TestCase
{
    protected $user;
    public function setUp():void
    {
        parent::setUp();
        $this->user = $this->createUser([
            'email_verified_at' => null
        ]);
        $this->actingAs($this->user, 'web');
        Queue::fake();
    }
    public function createUser($options = null): User
    {
        return User::factory()->create($options);
    }
    public function assertSendVerifyEmailJobIsDispatched($id)
    {
        Queue::assertPushed(SendVerifyEmailJob::class, function ($job) use ($id) {
            return $job->user->id == $id;
        });
    }
    public function test_send_verification_code(): void
    {
        $last_code = $this->user->verification_code;
        $response = $this->postJson('/email/send-verify');
        $response->assertOk();
        $this->assertSendVerifyEmailJobIsDispatched($this->user->id);
        $this->assertNotEquals($this->user->refresh()->verification_code,$last_code);
    }
    public function test_verify_code_success()
    {
        /* Set verification code */
        $this->postJson('/email/send-verify');
        $this->assertEquals($this->user->email_verified_at,null);
        $response = $this->postJson('/email/verify',['code' => $this->user->verification_code]);
        $this->assertNotEquals($this->user->refresh()->email_verified_at,null);
        $this->assertEquals($this->user->refresh()->status,RestaurantUser::ACTIVE);
        $response->assertOk();
    }
    public function test_verify_code_failed_invalid_code()
    {
        $response = $this->postJson('/email/verify',['code' => 'XXXXXX']);
        $response->assertStatus(403)
        ->assertJson([
            'success' => false,
            'message' => 'Fail',
        ]);
    }
    public function test_verify_email_is_already_verified()
    {
        $this->user->update(['email_verified_at' => now()]);
        $response = $this->postJson('/email/verify',['code' => 'XXXXXX']);
        $response->assertStatus(203);
    }
}
