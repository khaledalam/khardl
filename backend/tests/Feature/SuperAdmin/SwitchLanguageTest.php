<?php

namespace Tests\Feature\SuperAdmin;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SwitchLanguageTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        die;
        $response = $this->get(env('APP_URL'));

        app()->setlocale('en');

//        $this->assertEquals();
        dd($response->getContent());

        $response->assertStatus(200);
    }
}
