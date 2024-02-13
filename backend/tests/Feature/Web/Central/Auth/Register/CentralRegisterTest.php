<?php

namespace Tests\Feature\Web\Central\Auth\Login;

use App\Actions\CreateTenantAction;
use App\Jobs\SendVerifyEmailJob;
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
        return User::factory()->create($options);
    }
    private function createRestaurant($user, $domain)
    {
        $tenant =  (new CreateTenantAction)
        (
            user: $user,
            domain: $domain
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
        $this->assertSendVerifyEmailJobIsDispatched($user);
    }
    public function assertSendVerifyEmailJobIsDispatched($user)
    {
        Queue::assertPushed(SendVerifyEmailJob::class, function ($job) use ($user) {
            return $job->user->id == $user->id;
        });
    }

    public function assertSendVerifyEmailJobSendsEmail($user)
    {
        // Given
        Mail::fake();

        // Then
        Mail::assertSent(Mail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

}
