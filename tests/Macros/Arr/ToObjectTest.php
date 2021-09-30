<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class ToObjectTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('c', Arr::toObject(['a' => 'c'])->a);
        $this->assertEquals(null, Arr::toObject(['a', 'c']));
    }
}
