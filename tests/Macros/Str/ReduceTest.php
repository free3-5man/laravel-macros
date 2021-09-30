<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class ReduceTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(6, Str::reduce('123', function ($carry, $char) {
            return $carry + $char;
        }, 0));
    }
}
