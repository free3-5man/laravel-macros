<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class CharsTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(["H", "e", "l", "l", "o"], Str::chars('Hello'));
    }
}
