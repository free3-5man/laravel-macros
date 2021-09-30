<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class AllWordsTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals(['I', 'love', 'china'], Str::allWords('I love china!!!'));
        $this->assertEquals(['python', 'javaScript', 'coffee', 'first_name'], Str::allWords('python, javaScript & coffee first_name'));

        $this->assertEquals([], Str::allWords('- = , .'));
    }
}
