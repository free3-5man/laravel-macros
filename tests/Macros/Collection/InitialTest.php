<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class InitialTest extends TestCase
{
    /** @test */
    public function test()
    {
        $coll = collect([1, 2, 3]);
        $retColl = $coll->initial();
        $this->assertEquals([1, 2], $coll->toArray());
        $this->assertEquals([1, 2], $retColl->toArray());
    }
}
