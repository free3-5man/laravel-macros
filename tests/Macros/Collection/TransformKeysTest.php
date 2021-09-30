<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Str;

class TransformKeysTest extends TestCase
{
    /** @test */
    public function test()
    {
        $coll = collect([
            'First_name' => 'Adam',
            'last-name' => 'Smith',
        ]);
        $returnColl = $coll->transformKeys(function ($key) {
            return Str::camel($key);
        });
        $this->assertEquals([
            'firstName' => "Adam",
            'lastName' => "Smith",
        ], $coll->toArray());
        $this->assertEquals([
            'firstName' => "Adam",
            'lastName' => "Smith",
        ], $returnColl->toArray());
    }
}
