<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class RangeTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([0, 1, 2, 3, 4, 5], Arr::range(5));
        $this->assertEquals([3, 4, 5, 6, 7], Arr::range(7, 3));
        $this->assertEquals([0, 2, 4, 6, 8], Arr::range(9, 0, 2));
    }
}
