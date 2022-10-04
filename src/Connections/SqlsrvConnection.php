<?php

namespace QueryJson\Connections;

use Closure;

class SqlsrvConnection extends Connection
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
    protected function getWhereJsonIsValidCompiler(): Closure
    {
        return function(string $column): string {
            return "isjson($column) = 1";
        };
    }
}