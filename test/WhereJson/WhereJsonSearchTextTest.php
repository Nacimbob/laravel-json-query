<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\Stubs\JsonModel;
use QueryJson\Test\TestCase;
use QueryJson\Test\WhereJson\Traits\{
    WhereJsonSearchTextDataProvider,
};

class WhereJsonSearchTextTest extends TestCase
{
    use DatabaseMigrations;
    use WhereJsonSearchTextDataProvider;

    /**
     * @test
     * @dataProvider whereJsonSearchTextDataProvider
     */
    public function WhereJsonContains($data, $key, $value, $expected)
    {
        $this->insertData($data);

        foreach ([new JsonModel, \DB::table('test_json')] as $query) {
            $orQuery = clone $query;

            $this->assertEquals(
                $expected,
                $query->whereJsonSearchText('json', $key, $value)->count()
            );

            $this->assertEquals(
                $expected,
                $orQuery->whereRaw('1 = 0')->orWhereJsonSearchText('json', $key, $value)->count()
            );
        }

    }
}