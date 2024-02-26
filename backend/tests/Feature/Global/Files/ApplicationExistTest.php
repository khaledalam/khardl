<?php

namespace Tests\Feature\Global\Files;

use Tests\TestCase;

class ApplicationExistTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {

        echo 'APP_URL: ' . env('APP_URL');

        exec('curl -I http://khardl:8000');
        exec('curl -I http://127.0.0.1:8000');

        $response = $this->get(env('APP_URL'));
        $response->assertStatus(200);
    }
}
