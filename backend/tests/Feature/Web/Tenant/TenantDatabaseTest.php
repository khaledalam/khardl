<?php

namespace Tests\Feature\Web\Tenant;


use Tests\TenantTestCase;


class TenantDatabaseTest extends TenantTestCase
{

    protected $tenancy = true;

    public function test_is_restaurant_exists(): void
    {
        $this->assertTrue(\Schema::hasTable('settings'));
    }
    public function test_can_access_central_from_restaurant(): void
    {
        $this->assertFalse(\Schema::hasTable('central_settings'));
        $this->runCentral(function(){
            $this->assertTrue(\Schema::hasTable('central_settings'));
        });
    }


}
