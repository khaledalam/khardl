<?php

namespace Tests\Feature\API\Auth\Login\Branch;


use App\Models\Tenant\Branch;
use Tests\Feature\API\WorkerBase;


class UpdateBranchSettingsRequestTest extends WorkerBase
{
    /* branches/{branch}/delivery */
    public function test_update_delivery(): void
    {
        $branch = Branch::factory()->create();
        $this->worker->branch_id = $branch->id;
        $this->worker->save();
        $path = $this->baseURL."api/branches/$branch->id/delivery";
        $data = [
            'delivery_availability' => fake()->boolean,
            'pickup_availability' => fake()->boolean,
            'preparation_time_delivery' => fake()->dateTime->format('H:i:s')
        ];
        $response = $this->putJson($path, $data, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
        $response->assertOk();
        $response->assertJsonStructure([
            'success',
            'message',
            'data'
        ]);
        $this->assertDatabaseHas('branches',[
            'delivery_availability' => $data['delivery_availability'],
            'pickup_availability' => $data['pickup_availability'],
            'preparation_time_delivery' => $data['preparation_time_delivery'],
        ]);
    }


}
