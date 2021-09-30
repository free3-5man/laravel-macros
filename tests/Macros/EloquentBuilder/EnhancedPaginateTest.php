<?php

namespace Freeman\LaravelMacros\Test\Macros\EloquentBuilder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class EnhancedPaginateTest extends TestCase
{
    /** @test */
    public function test_enhanced_paginate()
    {
        $builder = User::query()->distinct();
        $paginator = $builder->paginate(10, ['gender']);
        $this->assertEquals(1, count($paginator->toArray()['data']));
        $this->assertEquals(3, $paginator->total());    // the total maybe wrong when query using distinct

        $builder = User::query()->distinct();
        $total = $builder->count('gender'); // query the exact total here
        $paginator = $builder->enhancedPaginate(10, ['gender'], null, $total);  // set total param to enhancedPaginate
        $this->assertEquals(1, count($paginator->toArray()['data']));
        $this->assertEquals(1, $paginator->total());    // the total here is correct

        $builder = User::query();
        $paginator = $builder->enhancedPaginate(10);
        $this->assertEquals(3, $paginator->total());
    }

    /** @test */
    public function test_enhanced_paginate_map_callback()
    {
        $paginator = User::query()->enhancedPaginate(10, ['id', 'name', 'height'], function($user) {
            // format height with cm
            return $user->fill([
                'height' => $user->height . ' cm',
            ]);
        });
        $this->assertEquals([
            'freeman' => "175 cm",
            'michael' => "185 cm",
            'david' => "165 cm",
        ], collect($paginator->toArray()['data'])->mapWithKeys(function ($item) {
            return [$item['name'] => $item['height']];
        })->toArray());
    }
}
