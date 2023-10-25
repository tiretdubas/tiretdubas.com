<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected static function assetsPath(string $file): string
    {
        return __DIR__.'/assets'.$file;
    }
}
