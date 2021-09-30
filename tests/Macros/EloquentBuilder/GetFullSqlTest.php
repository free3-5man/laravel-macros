<?php

namespace Freeman\LaravelMacros\Test\Macros\EloquentBuilder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class GetFullSqlTest extends TestCase
{
    /** @test */
    public function test()
    {
        $builder = User::query()->distinct()->select(['id', 'name']);

        $sql = 'select distinct "id", "name" from "users" where "users"."deleted_at" is null';
        $this->assertEquals($sql, $builder->getFullSql());
    }
}
