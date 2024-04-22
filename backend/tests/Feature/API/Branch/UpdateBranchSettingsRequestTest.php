<?php

namespace Tests\Feature\API\Branch;


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
        $path = "api/branches/$branch->id/delivery";
        $data = [
            'drivers_option' => fake()->boolean,
            'delivery_companies_option' => fake()->boolean,
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
            'drivers_option' => $data['drivers_option'],
            'delivery_companies_option' => $data['delivery_companies_option'],
            'pickup_availability' => $data['pickup_availability'],
            'preparation_time_delivery' => $data['preparation_time_delivery'],
        ]);
    }


}
