<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class AppendTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(collect([1, 2, 3, 0]), collect([1, 2, 3])->append(0));
    }
}
