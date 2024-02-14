<?php

namespace Tests;

use App\Models\Tenant;
use Illuminate\Support\Facades\URL;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
    public function ownPostJson($uri,$data,$header = [])
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
        $headers = array_merge($headers,$header);
        return $this->postJson($uri,$data,$headers);
    }
}
