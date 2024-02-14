<?php

namespace Tests\Feature\Web\Tenant\Auth\Login;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Tests\TenantTestCase;



class TenantLoginTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
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
        $path = "/login";
        $data = [
            'phone' => $this->user->phone
        ];
        $response = $this->ownPostJson($path, $data);
        $response->assertOk();
        $this->assertEquals($this->user->refresh()->status,RestaurantUser::INACTIVE);
        $this->assertEquals($this->user->refresh()->phone_verified_at,null);
        $this->assertEquals($this->user->refresh()->msegat_id_verification,"1234");//Testing
    }


}
