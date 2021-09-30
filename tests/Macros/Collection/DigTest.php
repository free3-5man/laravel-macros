<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class DigTest extends TestCase
{
    /** @test */
    public function test_dig()
    {
        $coll = collect([
            'level1' => [
                'level2' => [
                    'level3' => 'some data',
                ],
            ],
        ]);
        $this->assertEquals(['level3' => 'some data'], $coll->dig('level2'));
        $this->assertEquals('some data', $coll->dig('level3'));
        $this->assertEquals(null, $coll->dig('level4'));
    }

    /** @test */
    public function dig_will_find_nearest_path()
    {
        $coll = collect([
            'level1' => [
                'level2' => [
                    'level3' => 'some data',
                ],
            ],
            'level2' => [
                'level3' => [
                    'level1' => 'another data',
                ],
            ],
        ]);
        $this->assertEquals(['level1' => 'another data'], $coll->dig('level3'));
    }
}
