<?php

namespace Freeman\LaravelMacros\Test\Macros\EloquentBuilder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class AddAppendsTest extends TestCase
{
    /** @test */
    public function test()
    {
        $users = User::all(['name', 'gender']);

        $this->assertEquals([
            [
                'name' => 'freeman',
                'gender' => 'male',
                'gender_zh_cn' => '男',
            ],
            [
                'name' => 'michael',
                'gender' => 'male',
                'gender_zh_cn' => '男',
            ],
            [
                'name' => 'david',
                'gender' => 'male',
                'gender_zh_cn' => '男',
            ],
        ], $users->addAppends(['gender_zh_cn'])->toArray());
    }
}
