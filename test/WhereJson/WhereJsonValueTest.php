<?php

namespace QueryJson\Test\WhereJson;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use QueryJson\Test\Stubs\JsonModel;
use QueryJson\Test\TestCase;
use QueryJson\Test\WhereJson\Traits\{
    WhereJsonValueDataProvider,
    WhereJsonValueGtDataProvider,
    WhereJsonValueLikeDataProvider
};
class WhereJsonValueTest extends TestCase
{
    use DatabaseMigrations;
    use WhereJsonValueGtDataProvider;
    use WhereJsonValueDataProvider;
    use WhereJsonValueLikeDataProvider;

    /**
     * @test
     * @dataProvider whereJsonValueDataProvider
     * @dataProvider whereJsonValueGtDataProvider
     * @dataProvider WhereJsonValueLikeDataProvider
     */
    public function WhereJsonValue(array $data, string $path, $operator, $match, $expected)
    {
        $this->insertData($data);

        foreach ([JsonModel::query(), \DB::table('test_json')] as $query) {
            $result = $query->whereJsonValue('json'. $path, $operator, $match)
               ->count();
    
            $this->assertEquals(
                $expected,
                $result 
            );
        }

    }

    /**
     * @test
     * @dataProvider whereJsonValueDataProvider
     * @dataProvider whereJsonValueGtDataProvider
     * @dataProvider WhereJsonValueLikeDataProvider
     */
    public function orWhereJsonValue(array $data, string $path, $operator, $match, $expected)
    {
        $this->insertData($data);

        foreach ([JsonModel::query(), \DB::table('test_json')] as $query) {
            $query->WhereRaw('1 = 0');

            $result = $query->orWhereJsonValue('json'. $path, $operator, $match)
               ->count();
    
            $this->assertEquals(
                $expected,
                $result 
            );
        }

    }
}