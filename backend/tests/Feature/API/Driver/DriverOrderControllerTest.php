<?php

namespace Tests\Feature\API\Auth\Login\Branch;


use App\Http\Resources\API\Tenant\Collection\Driver\OrderCollection;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Order;
use Tests\Feature\API\DriverBase;


class DriverOrderControllerTest extends DriverBase
{
    public function test_index_method(): void
    {
        $order = Order::factory()->create([
            'driver_id' => $this->driver->id,
            'delivery_type_id' => DeliveryType::factory()->create(['name' => DeliveryType::DELIVERY]),
            'deliver_by' => null
        ]);
        $path = $this->baseURL."api/drivers-orders";
        $response = $this->getJson($path);
        $response->assertOk();
        $response->assertJsonCount(1, 'data.data');
        $this->assertInstanceOf(OrderCollection::class, $response->getOriginalContent()['data']);
        $this->assertDatabaseHas('orders',[
            'driver_id' => $this->driver->id,
            'status' => $response->getOriginalContent()['data'][0]['status'],
            'total' => $response->getOriginalContent()['data'][0]['total'],
        ]);
    }


}
