<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class MapTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('HellO', Str::map('Hello', function ($char) {
            return $char == 'o' ? 'O' : $char;
        }));
    }
}
