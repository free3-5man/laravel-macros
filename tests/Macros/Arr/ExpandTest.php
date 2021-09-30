<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class ExpandTest extends TestCase
{
    /** @test */
    public function test()
    {
        $array = ['products' => ['desk' => ['price' => 100]]];

        $dot = Arr::dot($array);
        $expand = Arr::expand($dot, '.');

        $this->assertEquals(['products.desk.price' => 100], $dot);
        $this->assertEquals($array, $expand);
    }
}
