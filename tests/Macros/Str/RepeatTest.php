<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class RepeatTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('foobarfoobarfoobar', Str::repeat('foobar', 3));
    }
}
