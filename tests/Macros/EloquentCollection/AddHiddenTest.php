<?php

namespace Freeman\LaravelMacros\Test\Macros\EloquentBuilder;

use Freeman\LaravelMacros\Test\BuilderTestCase as TestCase;
use Freeman\LaravelMacros\Test\Models\User;

class AddHiddenTest extends TestCase
{
    /** @test */
    public function test()
    {
        $users = User::all();

        $this->assertEquals([
            [
                'name' => 'freeman',
                'height' => 175,
            ],
            [
                'name' => 'michael',
                'height' => 185,
            ],
            [
                'name' => 'david',
                'height' => 165,
            ],
        ], $users->addHidden(['id', 'birthday', 'email', 'gender', 'created_at', 'updated_at'])->toArray());
    }
}
