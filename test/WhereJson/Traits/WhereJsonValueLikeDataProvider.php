<?php

namespace QueryJson\Test\WhereJson\Traits;

trait WhereJsonValueLikeDataProvider
{
    public function WhereJsonValueLikeDataProvider()
    {
        return [
            [
                [
                    json_encode([
                        [
                            "name" => "text to match for results",
                        ],
                    ]),
                    json_encode([
                        [
                            "name" => "text is matching the results",
                        ],
                        [
                            "name" => [
                                "name" => 2
                            ]
                        ]
                    ])
                ],
                "[0]->name",
                'like',
                '%match%',
                2
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
                'like',
                '%1_%',
                4
            ],
        ];
    }
}