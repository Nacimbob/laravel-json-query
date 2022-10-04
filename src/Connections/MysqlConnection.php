<?php

namespace QueryJson\Connections;

use Closure;

class MysqlConnection extends Connection
{
    /**
     * @inheritDoc
     */
    protected function getWhereJsonValueCompiler(): Closure
    {
        return function(string $column, string $operator): string {
            return "json_value($column, ?) $operator ?";
        };
    }

    /**
     * @inheritDoc
     */
    protected function getWhereJsonExistsCompiler(): Closure
    {
        return function(string $column): string {
            return  "json_exists($column, ?)";
        };
    }

    /**
     * @inheritDoc
     */
    protected function getWhereJsonIsValidCompiler(): Closure
    {
        return function(string $column): string {
            return "json_valid($column)";
        };
    }
}