<?php

namespace QueryJson\Compilers;

use Closure;

class MysqlQueryCompiler extends QueryCompiler
{
    /**
     * @inheritDoc
     */
    public function getWhereJsonValueCompiler(string $column, string $operator): string
    {
        return $this->getSelectJsonValueCompiler($column) . " $operator ?";
    }

    /**
     * @inheritDoc
     */
    public function getWhereJsonIsValidCompiler(string $column): string
    {
        return "json_valid($column) = 1";
    }

    /**
     * @inheritDoc
     */
    public function getWhereJsonIsInValidCompiler(string $column): string
    {
        return "json_valid($column) = 0";
    }

    /**
     * @inheritDoc
     */
    public function getSelectJsonValueCompiler(string $column, string $as = null): string
    {

        $query =  "json_unquote(json_extract($column, ?))" ;

        if (! is_null($as)) {
            $query .= " as $as";
        }

        return $query;
    } 
}