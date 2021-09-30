<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class ZipWithKeysTest extends TestCase
{
    /** @test */
    public function test_zipped_items_has_longger_length()
    {
        $this->assertEquals([
            'a' => 1,
            'b' => 2,
            'c' => null,
        ], collect(['a', 'b', 'c'])->zipWithKeys([1, 2])->toArray());
    }

    public function test_zipped_items_has_shorter_length()
    {
        $this->assertEquals([
            'a' => 1,
            'b' => 2,
        ], collect(['a', 'b'])->zipWithKeys([1, 2, 3])->toArray());
    }
}
