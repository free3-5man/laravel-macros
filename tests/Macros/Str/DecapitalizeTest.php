<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class DecapitalizeTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(' foo Bar ', Str::decapitalize(' Foo Bar '));
        $this->assertEquals(' hellO  world', Str::decapitalize(' HellO  World', true));
    }
}
