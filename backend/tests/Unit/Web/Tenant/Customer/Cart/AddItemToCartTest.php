<?php

namespace Tests\Unit\Web\Tenant\Customer\Cart;
use App\Http\Middleware\RestaurantLive;
use App\Http\Middleware\RestaurantSubLive;
use App\Models\Tenant\Item;
use Tests\TenantTestCase;

use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use App\Models\Tenant\RestaurantUser;



class AddItemToCartTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const path = "/carts";
    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser([
            'phone_verified_at' => now()
        ]);
        $this->actingAs($this->user,'web');
        $this->withoutMiddleware(RestaurantLive::class);
        $this->withoutMiddleware(RestaurantSubLive::class);
        $item = Item::factory()->create();
        dd($item);
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function test_add_item_to_cart_success()
    {
        $response = $this->postJson(self::path);
        $response->dump();
    }
}
