<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function stub(string $filename): string
    {
        return file_get_contents(base_path($filename));
    }
}
