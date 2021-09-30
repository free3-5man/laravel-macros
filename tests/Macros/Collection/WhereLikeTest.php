<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class WhereLikeTest extends TestCase
{
    /** @test */
    public function test_where_like_with_array()
    {
        $this->assertEquals(["foo", "hello", "world"], collect(["foo", "bar", "hello", "world"])->whereLike('o')->toArray());
    }

    public function test_where_like_with_assoc()
    {
        $this->assertEquals([
            ['foo' => "hello"],
            ['foo' => "world"],
        ], collect([
            ['foo' => "hello"],
            ['foo' => "bar"],
            ['foo' => "world"],
        ])->whereLike('foo', 'o')->toArray());
    }
}
