<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\Stubs\JsonModel;
use QueryJson\Test\TestCase;

class WhereJsonIsValidTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider isValidDataProvider
     */
    public function testWhereJsonIsValid($data, $expected)
    {
        $this->insertData($data);

        foreach ([JsonModel::query(), \DB::table('test_json')] as $query) {
            $this->assertEquals(
                $expected,
                $query->whereJsonIsValid('json')->count()
            );
        }
    }



    public function isValidDataProvider(): array
    {
        $array = ["key" => "value"];

        return [
            [
                $valid = [
                    json_encode($array),
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