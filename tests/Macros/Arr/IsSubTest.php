<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class IsSubTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertTrue(Arr::isSub([], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['a'], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['b'], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['b', 'c'], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['a', 'c'], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['c', 'b'], ['a', 'b', 'c']));
        $this->assertTrue(Arr::isSub(['a', 'c', 'b'], ['a', 'b', 'c']));

        $this->assertFalse(Arr::isSub(['d'], ['a', 'b', 'c']));
        $this->assertFalse(Arr::isSub(['a', 'd'], ['a', 'b', 'c']));
        $this->assertFalse(Arr::isSub(['a', 'b', 'c'], ['a', 'b']));
    }
}
