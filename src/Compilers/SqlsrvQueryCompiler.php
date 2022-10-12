<?php

namespace QueryJson\Compilers;

class SqlsrvQueryCompiler extends MysqlQueryCompiler
{
    /**
     * @inheritDoc
     */
    public function getWhereJsonIsValidCompiler(string $column): string
    {
        return "isjson($column) = 1";
    }

    /**
     * @inheritDoc
     */
    public function getWhereJsonIsInValidCompiler(string $column): string
    {
        return "isjson($column) = 0";
    }

        /**
     * @inheritDoc
     */
    public function getSelectJsonValueCompiler(string $column, string $as = null): string
    {

        $query =  "json_value($column, ?)" ;

        if (! is_null($as)) {
            $query .= " as $as";
        }

        return $query;
    }

    /**
    * @inheritDoc
    */
    public function getWhereJsonSearchTextCompiler($query, string $column, $searchBy, $searchValue)
    {
        $endsWith = '[,}]';

        return $query->where(
            function ($q) use ($column, $searchBy, $searchValue, $endsWith) {
                $q->where(
                    $column,
                    'like',
                    '%'. sprintf('"%s":%s%s', $searchBy, $searchValue, $endsWith). '%'
                )
                ->orWhere(
                    $column,
                    'like',
                    '%'. sprintf('"%s":"%s"%s', $searchBy, $searchValue, $endsWith). '%'
                );
            }

        );
    }
}