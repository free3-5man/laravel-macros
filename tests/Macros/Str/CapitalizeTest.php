<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class CapitalizeTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('Foo bar', Str::capitalize('foo bar'));
        $this->assertEquals('Hello World', Str::capitalize('hello world', true));
    }
}
