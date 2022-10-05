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
        return "json_value($column, ?) $operator ?";
    }

    /**
     * @inheritDoc
     */
    public function getWhereJsonIsValidCompiler(string $column): string
    {
        return "json_valid($column)";
    }
}