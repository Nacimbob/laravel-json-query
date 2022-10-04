<?php

namespace QueryJson\Test;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class WhereJsonTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider isValidDataProvider
     */
    public function testWhereJsonIsValid($data, $expected)
    {
        foreach ($data as $value) {
            \DB::table('test_json')->insert([
                'json' => $value
            ]);
        }

        $this->assertEquals(
            $expected ,
            \DB::table('test_json')->whereJsonIsValid('json')->count()
        );
    }

    public function isValidDataProvider(): array
    {
        $array = ["key" => "value"];

        return [
            [
                $valid = [
                    json_encode($array ),
                    json_encode([$array, $array, $array]),
                    json_encode([$array, $array, $array, [[[$array]]]]),
                ],
                count($valid)
            ],
            [
                [
                    "text" . json_encode([$array]),
                    "text" . json_encode([$array , $array]),
                ],
                0
            ],
        ];
    }
}