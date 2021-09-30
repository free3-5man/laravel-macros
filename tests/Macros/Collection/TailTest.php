<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class TailTest extends TestCase
{
    /** @test */
    public function test()
    {
        $coll = collect([1, 2, 3]);
        $retColl = $coll->tail();
        $this->assertEquals([2, 3], $coll->toArray());
        $this->assertEquals([2, 3], $retColl->toArray());
    }
}
