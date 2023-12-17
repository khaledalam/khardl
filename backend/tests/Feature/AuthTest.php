<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public static function getNewToken() {

    }

    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
