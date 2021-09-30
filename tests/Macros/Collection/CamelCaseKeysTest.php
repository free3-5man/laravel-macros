<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class CamelCaseKeysTest extends TestCase
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
        ])->camelCaseKeys()->toArray());
    }
}
