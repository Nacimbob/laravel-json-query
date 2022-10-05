<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\Stubs\JsonModel;
use QueryJson\Test\TestCase;

class WhereJsonIsInValidTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider isInValidDataProvider
     */
    public function testWhereJsonIsInValid($data, $expected)
    {
        $this->insertData($data);

        foreach ([JsonModel::query(), \DB::table('test_json')] as $query) {
            $this->assertEquals(
                $expected,
                $query->whereJsonIsInValid('json')->count()
            );
        }
    }

    /**
     * @dataProvider isInValidDataProvider
     */
    public function testOrWhereJsonIsInValid($data, $expected)
    {
        $this->insertData($data);

        foreach ([JsonModel::query(), \DB::table('test_json')] as $query) {
            $query->WhereRaw('1 = 0');

            $this->assertEquals(
                $expected,
                $query->orWhereJsonIsInValid('json')->count()
            );
        }
    }



    public function isInValidDataProvider(): array
    {
        $array = ["key" => "value"];

        return [
            [
                $valid = [
                    json_encode($array),
                    json_encode([$array, $array, $array]),
                    json_encode([$array, $array, $array, [[[$array]]]]),
                ],
                0
            ],
            [
                [
                    "text" . json_encode([$array]),
                    "text" . json_encode([$array , $array]),
                ],
                2
            ],
        ];
    }
}