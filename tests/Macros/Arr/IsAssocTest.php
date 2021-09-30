<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class IsAssocTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertFalse(Arr::isAssoc([]));
        $this->assertFalse(Arr::isAssoc(['a', 'b']));
        $this->assertFalse(Arr::isAssoc([0 => 'a', 1 => 'b']));
        $this->assertFalse(Arr::isAssoc(['0' => 'a', '1' => 'b']));
        $this->assertFalse(Arr::isAssoc([1, 2]));

        $this->assertTrue(Arr::isAssoc([2 => 'a', 3 => 'b']));
        $this->assertTrue(Arr::isAssoc(['2' => 'a', '3' => 'b']));
        $this->assertTrue(Arr::isAssoc(['a' => 2, 'b' => 3]));
    }
}
