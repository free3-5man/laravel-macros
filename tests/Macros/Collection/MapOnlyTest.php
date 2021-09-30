<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class MapOnlyTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            [
                'id' => 1,
                'name' => 'Michael',
            ],
            [
                'id' => 2,
                'name' => 'David',
            ],
            [
                'id' => 3,
                'name' => 'James',
            ],
        ], collect([
            [
                'id' => 1,
                'name' => 'Michael',
                'age' => 18,
            ],
            [
                'id' => 2,
                'name' => 'David',
                'age' => 20,
            ],
            [
                'id' => 3,
                'name' => 'James',
                'age' => 22,
            ],
        ])->mapOnly(['id', 'name'])->toArray());
    }
}
