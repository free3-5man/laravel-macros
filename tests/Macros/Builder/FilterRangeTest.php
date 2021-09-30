<?php

namespace Freeman\LaravelMacros\Test\Macros\Builder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class FilterRangeTest extends TestCase
{
    /** @test */
    public function test_filter_range()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'height' => 'height_field_in_request_query',
            ],
        ];
        $data = [
            'height_field_in_request_query_begin' => 170,
            'height_field_in_request_query_end' => 180,
        ];
        $builder->filterRange($whereFields, $useWhereDate = false, $data);
        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function test_filter_range_while_request_field_equals_to_db_field()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'height',
            ],
        ];
        $data = [
            'height_begin' => 170,
            'height_end' => 180,
        ];
        $builder->filterRange($whereFields, $useWhereDate = false, $data);
        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function test_filter_range_use_where_date()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'birthday',
            ],
        ];
        $data = [
            'birthday_begin' => '2020-01-15',
            'birthday_end' => '2020-02-15',
        ];
        $builder->filterRange($whereFields, $useWhereDate = true, $data);
        $this->assertEquals(1, $builder->count());
    }

    /** @test */
    public function test_filter_range_use_custom_suffix()
    {
        $builder = User::query();

        $whereFields = [
            'users' => [
                'birthday',
            ],
        ];
        $data = [
            'birthday_start' => '2020-01-15',
            'birthday_finish' => '2020-02-15',
        ];
        $builder->filterRange($whereFields, $useWhereDate = true, $data, '_start', '_finish');
        $this->assertEquals(1, $builder->count());
    }
}
