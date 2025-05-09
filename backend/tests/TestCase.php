<?php

namespace Tests;

use Exception;
use Faker\Factory;
use Faker\Generator;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    private Generator $faker;

    public function setUp()
    : void {

        parent::setUp();

        $this->faker = Factory::create();
    }

    public function __get($key) {
        throw new Exception('attempted to read non-existing property:'. $key);
    }

    public static function setTestingCentral(): void
    {
        putenv('TESTING_CENTRAL=1');
    }

    public static function setTestingTenant(): void
    {
        putenv('TESTING_CENTRAL=0');
    }
}
