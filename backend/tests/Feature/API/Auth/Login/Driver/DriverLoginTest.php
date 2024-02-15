<?php

namespace Tests\Feature\API\Auth\Login\Driver;

use Tests\Feature\API\DriverBase;


class DriverLoginTest extends DriverBase
{

    protected $tenancy = true;
    public function test_login(): void
    {
        $path = '/api/login';
        $data = [
            'email' => $this->driver->email,
            'password' => 'password' // As in factory
        ];
        $response = $this->postJson($path, $data, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
        $response->assertOk();
    }


}
