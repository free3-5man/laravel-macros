<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class OffsetTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([1, 2, 5], collect([2, 1, 2, 5])->offset(1)->values()->toArray());
    }
}
