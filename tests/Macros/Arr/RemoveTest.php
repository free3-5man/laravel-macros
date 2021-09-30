<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class RemoveTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(['a', 'b'], Arr::remove(['a', 'c', 'b'], 'c'));
        $this->assertEquals(['c', 'b'], Arr::remove(['a', 'c', 'b'], ['a']));
        $this->assertEquals(['c'], Arr::remove(['a', 'c', 'b'], ['a', 'b']));
    }
}
