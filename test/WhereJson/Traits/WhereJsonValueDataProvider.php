<?php

namespace QueryJson\Test\WhereJson\Traits;

trait WhereJsonValueDataProvider
{
    /**
     * @return array
     */
    public function whereJsonValueDataProvider(): array
    {
        return [
            [
                [
                    json_encode([
                        "key" => "matched text",
                        "another_key" => 20
                    ]),
                    json_encode([
                        "key" => "10",
                        "another_key" => 4937
                    ]),
                    json_encode([
                        "key" => "22",
                        "another_key" => 0
                    ]),
                    json_encode([
                        "key" => "unmatched text",
                        "another_key" => -35
                    ]),
                    json_encode([
                        "key" => "matched text",
                        "another_key" => -768
                    ])
                ],
                "->key",
                '=',
                "matched text",
                2
            ],
            [
                [
                    json_encode([
                        [
                            "key" => "-10",
                        ],
                    ])
                ],
                "[0]->key",
                '=',
                -10,
                1
            ],
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
                "2",
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