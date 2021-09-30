<?php

namespace Freeman\LaravelMacros\Test\Macros\Builder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class FilterTest extends TestCase
{
    /** @test */
    public function test_filter()
    {
        $builder = User::query();
        $this->assertEquals(3, $builder->count());

        $whereFields = [
            'users' => [
                'name' => 'name_field_in_request_query',
                'birthday' => 'birthday_field_in_request_query',
            ],
        ];
        $data = [
            'name_field_in_request_query' => 'michael',
            'birthday_field_in_request_query' => '2020-02-01',
        ];
        $builder->filter($whereFields, $useWhereIn = false, $data);
        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function test_filter_while_request_field_equals_to_db_field()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'name',
                'birthday',
            ],
        ];
        $data = [
            'name' => 'michael',
            'birthday' => '2020-02-01',
        ];
        $builder->filter($whereFields, $useWhereIn = false, $data);
        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function test_filter_use_where_in()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'name',
                'birthday',
            ],
        ];
        $data = [
            'name' => [
                'freeman',
                'michael',
            ],
            'birthday' => [
                '2020-02-01',
            ],
        ];
        $builder->filter($whereFields, $useWhereIn = true, $data);
        $this->assertEquals(1, $builder->count());
    }
}
