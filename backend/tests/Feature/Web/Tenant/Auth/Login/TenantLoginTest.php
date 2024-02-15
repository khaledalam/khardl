<?php

namespace Tests\Feature\Web\Tenant\Auth\Login;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TenantTestCase;



class TenantLoginTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const login_path = "/login";
    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function test_login_success(): void
    {
        $data = [
            'phone' => $this->user->phone
        ];
        $response = $this->ownPostJson(self::login_path, $data);
        $response->assertOk();
        $this->assertEquals($this->user->refresh()->status,RestaurantUser::INACTIVE);
        $this->assertEquals($this->user->refresh()->phone_verified_at,null);
        $this->assertEquals($this->user->refresh()->msegat_id_verification,"1234");//Testing
    }
    public function test_phone_required()
    {
        $response = $this->ownPostJson(self::login_path);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['phone']);
    }
    public function test_phone_not_exists()
    {
        $response = $this->ownPostJson(self::login_path,['phone' => fake()->numerify('966#########')]);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['phone']);
    }
    public function test_too_many_verification_attempts()
    {
        DB::table('phone_verification_tokens')->insert([
            'user_id' => $this->user->id,
            'created_at' => Carbon::today(),
            'attempts' => 3
        ]);
        $data = [
            'phone' => $this->user->phone
        ];
        $response = $this->ownPostJson(self::login_path, $data);
        $response->assertStatus(403)
        ->assertJson([
            'success' => false,
            'message' => 'Fail',
            'is_loggedin' => false,
            "data" =>  "Too many verification attempts. Request a new verification code."
        ]);
    }


}
