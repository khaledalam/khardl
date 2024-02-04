<?php

namespace Tests;

use Exception;
use Faker\Factory;
use App\Models\User;

use Faker\Generator;
use App\Models\Tenant;
use Spatie\Permission\Models\Role;
use App\Actions\CreateTenantAction;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Feature\Web\Central\CentralDatabaseTest;

abstract class TenantTestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    protected $tenancy = false;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }
    public function runCentral(Closure $fn){
        return tenancy()->central($fn);
    }
    public function initializeTenancy()
    {
        $centralTest = new CentralDatabaseTest("Central");
        $centralTest->test_central_database_is_freshed();
        $centralTest->test_create_new_restaurant();
        $restaurant = Tenant::first();
        tenancy()->initialize($restaurant);
    }
}
