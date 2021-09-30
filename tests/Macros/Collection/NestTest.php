<?php

namespace Freeman\LaravelMacros\Test\Macros\Collection;

use Freeman\LaravelMacros\Test\TestCase;

class NestTest extends TestCase
{
    private $comments = [
        ['id' => 1, 'comment_id' => null],
        ['id' => 2, 'comment_id' => 1],
        ['id' => 3, 'comment_id' => 1],
        ['id' => 4, 'comment_id' => 2],
        ['id' => 5, 'comment_id' => 4],
    ];

    /** @test */
    public function test_nest()
    {
        $expect = [
            [
                'id' => 1,
                'comment_id' => null,
                'children' => [
                    [
                        'id' => 2,
                        'comment_id' => 1,
                        'children' => [
                            [
                                'id' => 4,
                                'comment_id' => 2,
                                'children' => [
                                    [
                                        'id' => 5,
                                        'comment_id' => 4,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => 3,
                        'comment_id' => 1,
                    ],
                ],
            ]
        ];
        $this->assertEquals($expect, collect($this->comments)->nest('comment_id')->toArray());
    }

    /** @test */
    public function test_nest_with_param_key()
    {
        $comments = [
            ['_id' => 1, 'comment_id' => null],
            ['_id' => 2, 'comment_id' => 1],
            ['_id' => 3, 'comment_id' => 1],
            ['_id' => 4, 'comment_id' => 2],
            ['_id' => 5, 'comment_id' => 4],
        ];
        $expect = [
            [
                '_id' => 1,
                'comment_id' => null,
                'children' => [
                    [
                        '_id' => 2,
                        'comment_id' => 1,
                        'children' => [
                            [
                                '_id' => 4,
                                'comment_id' => 2,
                                'children' => [
                                    [
                                        '_id' => 5,
                                        'comment_id' => 4,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        '_id' => 3,
                        'comment_id' => 1,
                    ],
                ],
            ]
        ];
        $this->assertEquals($expect, collect($comments)->nest('comment_id', '_id')->toArray());
    }

    /** @test */
    public function test_nest_with_param_children()
    {
        $expect = [
            [
                'id' => 1,
                'comment_id' => null,
                'child' => [
                    [
                        'id' => 2,
                        'comment_id' => 1,
                        'child' => [
                            [
                                'id' => 4,
                                'comment_id' => 2,
                                'child' => [
                                    [
                                        'id' => 5,
                                        'comment_id' => 4,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => 3,
                        'comment_id' => 1,
                    ],
                ],
            ]
        ];
        $this->assertEquals($expect, collect($this->comments)->nest('comment_id', 'id', 'child')->toArray());
    }

    /** @test */
    public function test_nest_with_param_show_children_as_emtpy_array_when_not_exists()
    {
        $expect = [
            [
                'id' => 1,
                'comment_id' => null,
                'children' => [
                    [
                        'id' => 2,
                        'comment_id' => 1,
                        'children' => [
                            [
                                'id' => 4,
                                'comment_id' => 2,
                                'children' => [
                                    [
                                        'id' => 5,
                                        'comment_id' => 4,
                                        'children' => [],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'id' => 3,
                        'comment_id' => 1,
                        'children' => [],
                    ],
                ],
            ]
        ];
        $this->assertEquals($expect, collect($this->comments)->nest('comment_id', 'id', 'children', true)->toArray());
    }
}
