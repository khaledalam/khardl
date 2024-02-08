<?php

namespace Tests\Feature\API;


use App\Models\Tenant\RestaurantUser;
use Spatie\Permission\Models\Role;
use Tests\TenantTestCase;


class DriverBase extends TenantTestCase
{

    protected $tenancy = true;
    public $driver;

    public function setUp(): void
    {
        parent::setUp();
        $this->driver = RestaurantUser::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Driver']);
        $this->driver->assignRole($role);
        $this->actingAs($this->driver, 'web');
    }
}
