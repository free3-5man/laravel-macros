<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class SnakeCaseKeysTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertEquals([
            'first_name' => "Adam",
            'last_name' => "Smith",
        ], collect([
            'First_name' => 'Adam',
            'lastName' => 'Smith',
        ])->snakeCaseKeys()->toArray());
    }
}
