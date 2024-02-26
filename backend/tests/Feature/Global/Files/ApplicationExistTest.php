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

        $response = $this->get(env('APP_URL'));
        $response->assertStatus(200);
    }
}
