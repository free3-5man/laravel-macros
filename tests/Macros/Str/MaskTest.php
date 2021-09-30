<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class MaskTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('******7890', Str::mask('1234567890', 0, 6));
        $this->assertEquals('1234567***', Str::mask('1234567890', 7, 3));
        $this->assertEquals('1234$$$890', Str::mask('1234567890', 4, 3, '$'));
    }
}
