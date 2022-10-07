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
        ];
    }
}