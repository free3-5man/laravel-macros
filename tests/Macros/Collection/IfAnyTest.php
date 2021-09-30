<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class IfAnyTest extends TestCase
{
    /** @test */
    public function any_items_in_a_collection_meet_the_condition()
    {
        $this->assertTrue(collect([0, 1, 2])->ifAny(function ($item) {
            return $item > 1;
        }));
    }

    /** @test */
    public function all_items_in_a_collection_doesnt_meet_the_condition()
    {
        $this->assertFalse(collect([0, 1])->ifAny(function ($item) {
            return $item > 1;
        }));
    }

    /** @test */
    public function all_items_in_a_collection_is_false()
    {
        $this->assertFalse(collect([0, '0', false, null, [], ''])->ifAny());
    }
}
