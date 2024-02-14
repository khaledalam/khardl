<?php

namespace Tests\Feature\Web\Central\Auth\Login;

use App\Jobs\SendVerifyEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;


class VerificationCodeTest extends TestCase
{
    public function setUp():void
    {
        parent::setUp();
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
        $user = $this->createUser([
            'email_verified_at' => null
        ]);
        $last_code = $user->verification_code;
        $this->actingAs($user, 'web');
        $response = $this->postJson('/email/send-verify');
        $response->assertOk();
        $this->assertSendVerifyEmailJobIsDispatched($user->id);
        $this->assertNotEquals($user->refresh()->verification_code,$last_code);
    }
}
