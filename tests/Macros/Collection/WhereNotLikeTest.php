<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class WhereNotLikeTest extends TestCase
{
    /** @test */
    public function test_where_not_like_with_array()
    {
        $this->assertEquals(["bar"], collect(["foo", "bar", "hello", "world"])->whereNotLike('o')->toArray());
    }

    public function test_where_not_like_with_assoc()
    {
        $this->assertEquals([
            ['foo' => "bar"],
        ], collect([
            ['foo' => "hello"],
            ['foo' => "bar"],
            ['foo' => "world"],
        ])->whereNotLike('foo', 'o')->toArray());
    }
}
