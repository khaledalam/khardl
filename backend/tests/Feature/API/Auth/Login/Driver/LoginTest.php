<?php

namespace Tests\Feature\API\Auth\Login\Driver;


use App\Models\Tenant\RestaurantUser;
use Spatie\Permission\Models\Role;
use Tests\TenantTestCase;


class LoginTest extends TenantTestCase
{

    protected $tenancy = true;
    public $driver;

    public function setUp(): void
    {
        parent::setUp();
        $this->driver = RestaurantUser::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Driver']);
        $this->driver->assignRole($role);
    }
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
