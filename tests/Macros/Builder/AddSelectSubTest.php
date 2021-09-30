<?php

namespace Freeman\LaravelMacros\Test\Macros\Builder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\Article;
use Freeman\LaravelMacros\Test\Models\User;
use Illuminate\Support\Facades\DB;

class AddSelectSubTest extends TestCase
{
    /** @test */
    public function test()
    {
        $builder = User::query()->select([
            'name',
        ]);

        $builder->addSelectSub('sub_articles_count', Article::query()
            ->whereColumn('author_id', 'users.id')
            ->select(DB::raw('count(id)')));

        $this->assertEquals([
            [
                "name" => "freeman",
                "sub_articles_count" => "5",
            ],
            [
                "name" => "michael",
                "sub_articles_count" => "3",
            ],
            [
                "name" => "david",
                "sub_articles_count" => "8",
            ],
        ], $builder->get()->toArray());
    }
}
