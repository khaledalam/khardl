<?php

namespace Tests\Feature\Web\Central;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Models\User;
use App\Actions\CreateTenantAction;
use Illuminate\Support\Facades\Artisan;


class CentralDatabaseTest extends TestCase
{


    public function test_central_database_is_freshed(): void
    {
        Artisan::call('migrate:fresh');
        $this->assertTrue(\Schema::hasTable('central_settings'));
        $this->assertTrue(\Schema::hasTable('users'));
    }
    public function test_central_database_is_refreshed(): void
    {
        Artisan::call('migrate:refresh');
        $this->assertTrue(\Schema::hasTable('central_settings'));
        $this->assertTrue(\Schema::hasTable('users'));
    }
    public function test_central_database_is_seeds(): void
    {
        Artisan::call('migrate --seed');
        $this->assertDatabaseCount('central_settings', 1);
        $this->assertDatabaseHas('roles', ['name' => 'Administrator']);
    }
    public function test_create_new_restaurant(): void
    {
        $user = User::factory()->create();
        $restaurant =  (new CreateTenantAction)
        (
            user: $user,
            domain: 'first',
        );
        tenancy()->initialize($restaurant);
        $this->assertTrue(\Schema::hasTable('branches'));
        tenancy()->end();
    }

}
