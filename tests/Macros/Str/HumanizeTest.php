<?php

namespace Freeman\LaravelMacros\Test\Macros\Str;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class HumanizeTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals('Capitalize dash camel case underscore trim', Str::humanize('  capitalize dash-CamelCase_underscore trim  '));
    }
}
