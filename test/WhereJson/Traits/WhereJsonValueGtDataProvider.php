<?php

namespace QueryJson\Test\WhereJson\Traits;

trait WhereJsonValueGtDataProvider
{
    public function whereJsonValueGtDataProvider()
    {
        return [
            [
                [
                    json_encode([
                        [
                            "score" => 22,
                        ],
                    ]),
                    json_encode([
                        [
                            "score" => "8",
                        ],
                    ]),
                    json_encode([
                        [
                            "score" => "2",
                        ],
                    ]),
                    json_encode([
                        [
                            "score" => "",
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[0]->score",
                '>',
                7,
                2
            ],
            [
                [
                    json_encode([
                        [
                            "name" => "22",
                        ],
                    ]),
                    json_encode([
                        [
                            "name" => "-235",
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[0]->name",
                '>',
                10,
                1
            ],
            [
                [
                    json_encode([
                        "key" => "11",
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
                        "key" => -10,
                        "another_key" => -35
                    ]),
                    json_encode([
                        "key" => "-10",
                        "another_key" => -768
                    ])
                ],
                "->key",
                '>',
                10,
                2
            ],
            [
                [
                    json_encode([
                        "key_02" => "-10",
                        "another_key" => -768
                    ]),
                    json_encode([
                        "key_02" => -768
                    ]),
                    json_encode([
                        "key_02" => "10",
                        "another_key" => 4937
                    ]),
                    json_encode([
                        "key_02" => "21",
                    ]),
                    json_encode([
                        "key_02" => 42,
                    ]),
                    json_encode([
                        "name_02" => 42,
                    ]),
                    json_encode([
                        "key_05" => "11",
                        "another_key" => 20
                    ]),
                    json_encode([
                        "key_03" => "22",
                        "another_key" => 0
                    ]),
                    json_encode([
                        "key_01" => -10,
                        "another_key" => -35
                    ]),
                    json_encode([
                        "name" => -768
                    ])
                ],
                "->key_02",
                '>=',
                10,
                3
            ],
        ];
    }
}