<?php

namespace Tests;

use App\Bootstrapper\AuthBootstrapper;
use App\Models\Tenant\RestaurantUser;
use App\Providers\TenancyAuthProvider;
use App\Providers\TenancyAuthTestProvider;
use Exception;
use Faker\Factory;
use App\Models\User;

use Faker\Generator;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Mockery;
use Spatie\Permission\Models\Role;
use App\Actions\CreateTenantAction;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Stancl\Tenancy\Facades\Tenancy;

use Tests\Feature\Web\Central\CentralDatabaseTest;

abstract class TenantTestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $tenancy = false;
    protected $central_domain;
    protected $port = 8000;

    public function setUp(): void
    {
        parent::setUp();
        if ($this->tenancy) {
            $this->initializeTenancy();
            $subdomain = tenancy()->tenant?->restaurant_name;
            $this->central_domain = env('CENTRAL_DOMAIN');
            $url = 'http://'.$subdomain . '.' . $this->central_domain . ':' . $this->port;
            URL::forceRootUrl($url);
        }
    }
    public function runCentral(Closure $fn)
    {
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
