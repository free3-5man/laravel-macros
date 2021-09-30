<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class EqualsTest extends TestCase
{
    /** @test */
    public function collect_an_array_equals_an_array()
    {
        $this->assertTrue(collect([1, 2, 3])->equals([1, 2, 3]));
    }

    /** @test */
    public function collect_an_array_equals_a_collection()
    {
        $this->assertTrue(collect([1, 2, 3])->equals(collect([1, 2, 3])));
    }

    /** @test */
    public function array_index_not_equals()
    {
        $this->assertFalse(collect([
            0 => 1,
            2 => 2,
            3 => 3,
        ])->equals([1, 2, 3]));
    }

    /** @test */
    public function array_index_equals()
    {
        $this->assertTrue(collect([
            0 => 1,
            2 => 2,
            3 => 3,
        ])->equals([
            0 => 1,
            2 => 2,
            3 => 3,
        ]));
    }

    /** @test */
    public function collect_assoc_array_equals_though_string_keys()
    {
        dump(collect([1, 2, 3, 1, 2, 3])->search(2));
        $this->assertTrue(collect([
            0 => 1,
            2 => 2,
            'a' => 3,
            '3' => 'c',
        ])->equals([
            0 => 1,
            '2' => 2,
            'a' => 3,
            3 => 'c',
        ]));
    }
}
