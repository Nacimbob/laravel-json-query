<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\TestCase;

class WhereJsonValueTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @dataProvider whereJsonValueDataProvider
     */
    public function WhereJsonValue(array $data, string $path, $operator, $match, $expected)
    {
        foreach ($data as $value) {
            \DB::table('test_json')->insert([
                'json' => $value
            ]);
        }

        $result = \DB::table('test_json')->whereJsonValue('json'. $path, $operator, $match)
           ->count();

        $this->assertEquals(
            $expected,
            $result 
        );
    }



    /**
     * @return array
     */
    public function whereJsonValueDataProvider(): array
    {
        return [
            [
                [
                    json_encode([
                        [
                            "name" => "text",
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[0]->name",
                '=',
                "text",
                1
            ],
            [
                [
                    json_encode([
                        [
                            "name" => 1,
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[0]->invalid",
                '=',
                null,
                0
            ],
            [
                [
                    json_encode([
                        [
                            "name" => 1,
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[1]->name->name",
                "=",
                2,
                1
            ],
            [
                [
                    json_encode([
                        [
                            "username" => "nacim boubrit",
                            "password" => "********",
                        ],
                        [
                            "favorites" => [ 
                                "sport",
                                "reading",
                                "got"
                            ]
                        ]
                    ]),
                    json_encode([
                        [
                            "username" => "nacim boubrit",
                            "favorites" => [
                                "sport",
                                "reading",
                                "got"
                            ]
                        ],
                    ])

                ],
                "[0]->username",
                "=",
                "nacim boubrit",
                2
            ],
        ];
    }
}