<?php

namespace Freeman\LaravelMacros\Test\Macros\Builder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class FilterWhereNullTest extends TestCase
{
    /** @test */
    public function test_filter_where_null()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'email' => 'email_field_in_request_query',
            ],
        ];
        $data = [
            'email_field_in_request_query' => null,
        ];
        $builder->filterWhereNull($whereFields, $data);
        $this->assertEquals(2, $builder->count());
    }

    /** @test */
    public function test_filter_where_null_while_request_field_equals_to_db_field()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'email',
            ],
        ];
        $data = [
            'email' => null,
        ];
        $builder->filterWhereNull($whereFields, $data);
        $this->assertEquals(2, $builder->count());
    }
}
