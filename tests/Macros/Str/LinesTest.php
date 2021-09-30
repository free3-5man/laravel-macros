<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class LinesTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(['This', 'is a', 'multiline', 'string.', ''], Str::lines("This\nis a\nmultiline\nstring.\n"));
    }
}
