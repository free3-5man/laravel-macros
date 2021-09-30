<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class LowerCaseKeysTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            'first_name' => "Adam",
            'lastname' => "Smith",
        ], collect([
            'First_name' => 'Adam',
            'lastName' => 'Smith',
        ])->lowerCaseKeys()->toArray());
    }
}
