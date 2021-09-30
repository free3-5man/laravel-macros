<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class IfAllTest extends TestCase
{
    /** @test */
    public function all_items_in_a_collection_meet_the_condition()
    {
        $this->assertTrue(collect([2, 3, 4])->ifAll(function ($item) {
            return $item > 1;
        }));
    }

    /** @test */
    public function not_all_items_in_a_collection_meet_the_condition()
    {
        $this->assertFalse(collect([1, 2, 3, 4])->ifAll(function ($item) {
            return $item > 1;
        }));
    }

    /** @test */
    public function all_items_in_a_collection_is_true()
    {
        $this->assertTrue(collect([1, '1', true, 'null'])->ifAll());
    }
}
