<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class LimitTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([2, 1], collect([2, 1, 2, 5])->limit(2)->toArray());
    }
}
