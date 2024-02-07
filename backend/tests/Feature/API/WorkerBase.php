<?php

namespace Tests\Feature\API;


use App\Models\Tenant\RestaurantUser;
use Spatie\Permission\Models\Role;
use Tests\TenantTestCase;


class WorkerBase extends TenantTestCase
{

    protected $tenancy = true;
    public $worker;

    public function setUp(): void
    {
        parent::setUp();
        $this->worker = RestaurantUser::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Worker']);
        $this->worker->assignRole($role);
        $this->actingAs($this->worker, 'web');
    }
}
