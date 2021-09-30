<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class IndexOfAllTest extends TestCase
{
    /** @test */
    public function default_not_strict_mode()
    {
        $this->assertEquals([0, 3], collect([1, 2, 3, 1, 2, 3])->indexOfAll(1));
    }

    /** @test */
    public function strict_mode()
    {
        $this->assertEquals([3], collect(['1', 2, 3, 1, 2, 3])->indexOfAll(1, true));
    }

    /** @test */
    public function value_never_occurs_returns_empty_array()
    {
        $this->assertEquals([], collect([1, 2, 3])->indexOfAll(4));
    }
}
