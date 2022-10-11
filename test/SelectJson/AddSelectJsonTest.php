<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\Stubs\JsonModel;
use QueryJson\Test\TestCase;

class AddSelectJsonTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @dataProvider addSelectJsonDataProvider
     */
    public function selectJsonValueTest(array $data, array $queryParams, $assertion)
    {
        $this->insertData($data);
    
        $data = array_map(function($value) {
            return json_decode($value, true);
        }, $data);

        foreach ([JsonModel::whereRaw('1 = 1'), \DB::table('test_json')] as $query) {
            foreach ($queryParams as $path => $as) {
                $query->addSelectJson('json'. $path, $as);
            }

            $assertion(
                $data,
                json_decode(json_encode($query->get()->toArray()), true)
            );
        }
    }

    /**
     * @return array
     */
    public function addSelectJsonDataProvider(): array
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
                ["->key" => 'json_key'],
                function ($input, $result) {
                    $input = array_column($input, 'key');
                    $result = array_column($result, 'json_key');
                    
                    sort($input);
                    sort($result);

                    $this->assertEquals($input, $result);
                }
            ],
            [
                [
                    json_encode([
                        "id" => 1,
                        "json_key" => "matched text",
                        "another_json_key" => "20"
                    ]),
                    json_encode([
                        "id" => 2,
                        "json_key" => "10",
                        "another_json_key" => 4937
                    ]),
                    json_encode([
                        "id" => 3,
                        "json_key" => "22",
                        "another_json_key" => "0"
                    ]),
                    json_encode([
                        "id" => 4,
                        "json_key" => "unmatched text",
                        "another_json_key" => "-35"
                    ]),
                    json_encode([
                        "id" => 5,
                        "json_key" => "matched text",
                        "another_json_key" => -768
                    ])
                ],
                [
                    "->id" => 'id',
                    "->json_key" => 'json_key',
                    "->another_json_key" => "another_json_key"
                ],
                function ($input, $result) {
                    $input = array_column($input, null, 'id');
                    $result = array_column($result, null, 'id');
                    
                    ksort($input);
                    ksort($result);

                    $this->assertEquals($input, $result);
                }
            ],
            [
                [
                    json_encode([
                        "json_key" => "null",
                        "another_key" => 35
                    ]),
                    json_encode([
                        "json_key" => "null",
                        "another_key" => -35
                    ]),
                    json_encode([
                        "json_key" => "matched text",
                        "another_key" => -768
                    ])
                ],
                ["->json_key" => 'json_key'],
                function ($input, $result) {

                    $input = array_column($input, 'json_key');
                    $result = array_column($result, 'json_key');
                    
                    sort($input);
                    sort($result);

                    $this->assertEquals($input, $result);
                }
            ],
        ];
    }
}