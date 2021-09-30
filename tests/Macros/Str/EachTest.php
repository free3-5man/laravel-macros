<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class EachTest extends TestCase
{
    /** @test */
    public function test()
    {
        $indexOfO = null;
        Str::each('Hello', function ($char, $index) use(&$indexOfO) {
            if($char == 'o')
                $indexOfO = $index;
        });
        $this->assertEquals(4, $indexOfO);
    }
}
