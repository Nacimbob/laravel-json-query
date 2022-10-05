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
}