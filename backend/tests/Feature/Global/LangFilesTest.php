<?php

namespace Tests\Feature\Global;

use Tests\TestCase;

class LangFilesTest extends TestCase
{
    public function test_language_file_exists()
    {
        $arFilePath = resource_path('lang/ar.json');
        $enFilePath = resource_path('lang/en.json');

        // Assert that the file exists
        $this->assertFileExists($arFilePath);
        $this->assertFileExists($enFilePath);

    }
    public function test_language_file_has_no_errors()
    {
        $arFilePath = resource_path('lang/ar.json');
        $enFilePath = resource_path('lang/en.json');

        // Assert that the file exists
        $this->assertFileNoError($arFilePath);
        $this->assertFileNoError($enFilePath);
    }
    public function assertFileNoError($path)
    {
        $translations = file_get_contents($path);
        $this->assertNotEquals(json_decode($translations),null);
    }
}
