<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class BuildQueryTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('per_page=10&page=1&a%5Bb%5D=c&d%5B0%5D=e', Arr::buildQuery([
            'per_page' => 10,
            'page' => 1,
            'a' => [
                'b' => 'c',
            ],
            'd' => ['e'],
        ]));
    }
}
