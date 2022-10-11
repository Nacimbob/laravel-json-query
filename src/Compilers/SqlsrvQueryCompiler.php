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
}