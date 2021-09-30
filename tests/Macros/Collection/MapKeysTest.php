<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class MapKeysTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            'firstName' => "Adam",
            'lastName' => "Smith",
        ], collect([
            'First_name' => 'Adam',
            'last-name' => 'Smith',
        ])->mapKeys(function($key) {
            return Str::camel($key);
        })->toArray());
    }
}
