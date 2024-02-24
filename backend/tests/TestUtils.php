<?php

namespace Tests;

class TestUtils
{
    public static function setTestingCentral(): void
    {
        putenv('TESTING_CENTRAL=1');
    }

    public static function setTestingTenant(): void
    {
        putenv('TESTING_CENTRAL=0');
    }
}
