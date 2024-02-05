<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhoneValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_phone_examples(): void
    {
        $response = $this->get('/');
        

        $response->assertStatus(200);
    }

}
