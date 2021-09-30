<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class ToCSVTest extends TestCase
{
    /** @test */
    public function test_to_csv()
    {
        $this->assertEquals('a,b\nc,d', collect([['a', 'b'], ['c', 'd']])->toCSV());
    }

    public function test_param_delimiter()
    {
        $this->assertEquals('a;b\nc;d', collect([['a', 'b'], ['c', 'd']])->toCSV(';'));
    }
}
