<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class RepeatTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([2, 2, 2, 2, 2], Arr::repeat(5, 2));
        $this->assertEquals(['2', '2', '2', '2', '2'], Arr::repeat(5, '2'));
    }
}
