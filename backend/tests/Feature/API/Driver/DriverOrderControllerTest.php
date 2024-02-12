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
        // Create a new order
        $order = $this->createOrderForIndex(Order::RECEIVED_BY_RESTAURANT);

        // Test fetching all orders
        $this->assertOrdersByStatusCount('api/driver/drivers-orders', 1);

        // Test fetching orders with status 'ready'
        $this->assertOrdersByStatusCount('api/driver/drivers-orders?status=ready', 1);

        // Assign the order to a driver and change its status
        $order->update(['driver_id' => $this->driver->id, 'status' => Order::ACCEPTED]);

        // Test fetching orders with status 'accepted'
        $this->assertOrdersByStatusCount('api/driver/drivers-orders?status=' . Order::ACCEPTED, 1);

        // Assert database has the updated order
        $this->assertDatabaseHas('orders',[
            'driver_id' => $this->driver->id,
            'status' => Order::ACCEPTED,
            'total' => $order->total,
        ]);
    }

    private function createOrderForIndex($status)
    {
        return Order::factory()->create([
            'delivery_type_id' => DeliveryType::factory()->create(['name' => DeliveryType::DELIVERY]),
            'deliver_by' => null,
            'status' => $status,
            'driver_id' => null
        ]);
    }

    private function assertOrdersByStatusCount($path, $expectedCount)
    {
        $response = $this->getJson($this->baseURL . $path);
        $response->assertOk();
        $response->assertJsonCount($expectedCount, 'data.data');
        $this->assertInstanceOf(OrderCollection::class, $response->getOriginalContent()['data']);
    }
    public function test_change_status_method()
    {
        // Create order
        $order = $this->createOrder(Order::RECEIVED_BY_RESTAURANT);

        // Change status to accepted
        $this->changeOrderStatus($order, Order::ACCEPTED);
        $this->assertEquals(Order::ACCEPTED, $order->refresh()->status);
        $this->assertEquals($order->refresh()->driver_id, $this->driver->id);

        // Change status to completed
        $this->changeOrderStatus($order, Order::COMPLETED);
        $this->assertEquals(Order::COMPLETED, $order->refresh()->status);

        // Change status to cancelled
        $order->update(['status' => Order::ACCEPTED]); // Reset status to ACCEPTED
        $this->changeOrderStatus($order, Order::CANCELLED,"Not found customer at :".fake()->streetAddress);
        $this->assertEquals(Order::CANCELLED, $order->refresh()->status);
    }

    private function createOrder($status)
    {
        return Order::factory()->create([
            'driver_id' => null,
            'delivery_type_id' => DeliveryType::factory()->create(['name' => DeliveryType::DELIVERY]),
            'deliver_by' => null,
            'status' => $status
        ]);
    }

    private function changeOrderStatus($order, $status, $reason = null)
    {
        $path = $this->baseURL . "api/driver/change-status/" . $order->id;
        $response = $this->postJson($path, ['status' => $status,'reason' => $reason]);
        $response->assertOk();
    }


}
