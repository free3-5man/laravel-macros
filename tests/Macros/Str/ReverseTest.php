<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class ReverseTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('raboof', Str::reverse('foobar'));
    }
}
