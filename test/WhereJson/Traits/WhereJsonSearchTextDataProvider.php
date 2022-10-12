<?php

namespace QueryJson\Test\WhereJson\Traits;

trait WhereJsonSearchTextDataProvider
{
    /**
     * @return array
     */
    public function whereJsonSearchTextDataProvider(): array
    {
        return [
            [
                [
                    json_encode([
                        [
                            "key" => "10",
                        ],
                    ])
                ],
                'key',
                "10",
                1
            ],
            [
                [
                    json_encode([
                        [
                            "key" => -34,
                        ],
                    ])
                ],
                'key',
                -34,
                1
            ],
            [
                [
                    json_encode([
                        [
                            "key" => 500,
                        ],
                    ])
                ],
                'key',
                50,
                0
            ],
            [
                [
                    json_encode([
                        [
                            "key" => "10",
                        ],
                        [
                            "key_36" => "-8338989",
                        ],
                    ])
                ],
                'key_36',
                "-8338989",
                1
            ],
            [
                [
                    json_encode([
                        [
                            "name" => [
                                "first_name" => "cancod",
                            ]
                        ],
                    ])
                ],
                'first_name',
                "canco",
                0
            ],
            [
                [
                    json_encode([
                        [
                            "name" => [
                                "first_name" => "cancod",
                            ]
                        ],
                    ])
                ],
                'first_name',
                "cancod",
                1
            ],
        ];
    }
}