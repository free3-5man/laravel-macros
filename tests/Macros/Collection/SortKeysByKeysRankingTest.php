<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class SortKeysByKeysRankingTest extends TestCase
{
    /** @test */
    public function test()
    {
        // assertEquals <=> ==
        // so use === here
        $this->assertTrue([
            'C' => 'c',
            'B' => 'b',
            'A' => 'a',
            'E' => 'e',
            'D' => 'd',
        ] === collect([
            'A' => 'a',
            'B' => 'b',
            'C' => 'c',
            'D' => 'd',
            'E' => 'e',
        ])->sortKeysByKeysRanking([
            'A' => 3,
            'B' => 2,
            'C' => 1,
            'D' => 5,
            'E' => 4,
        ])->toArray());
    }
}
