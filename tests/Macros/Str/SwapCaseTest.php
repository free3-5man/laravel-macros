<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class SwapCase extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('hELLO', Str::swapCase('Hello'));
    }
}
