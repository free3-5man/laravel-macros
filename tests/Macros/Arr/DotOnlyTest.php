<?php

namespace Freeman\LaravelMacros\Test\Macros\Arr;

use Freeman\LaravelMacros\Test\TestCase;
use Illuminate\Support\Arr;

class DotOnlyTest extends TestCase
{
    /** @test */
    public function test()
    {
        $array = [
            'user' => [
                'id' => 1,
                'email' => 'a@a.com',
                'password' => 'password1',
                'profile' => [
                    'birthday' => '2000-01-01',
                    'gender' => 'male',
                ],
            ],
        ];
        $keys = [
            'user.id',
            'user.email',
            'user.profile.birthday',
        ];

        $this->assertEquals([
            "user" => [
                "id" => 1,
                "email" => "a@a.com",
                "profile" => [
                    "birthday" => "2000-01-01",
                ],
            ],
        ], Arr::dotOnly($array, $keys));
    }
}
