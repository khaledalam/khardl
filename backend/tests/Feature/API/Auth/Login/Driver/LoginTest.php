<?php

namespace Tests\Feature\API\Auth\Login\Driver;


use App\Models\Tenant\RestaurantUser;
use Spatie\Permission\Models\Role;
use Tests\Feature\API\DriverBase;
use Tests\TenantTestCase;


class LoginTest extends DriverBase
{

    protected $tenancy = true;
    public function test_login(): void
    {
        $path = $this->baseURL.'api/login';
        $data = [
            'email' => $this->driver->email,
            'password' => 'password' // As in factory
        ];
        $response = $this->postJson($path, $data, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
        $response->assertOk();
    }


}
