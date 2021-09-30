<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class KebabCaseKeysTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            'first-name' => "Adam",
            'last-name' => "Smith",
        ], collect([
            'First_name' => 'Adam',
            'lastName' => 'Smith',
        ])->kebabCaseKeys()->toArray());
    }
}
