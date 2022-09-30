<?php

namespace QueryJson\ConnectionQueryJson;

use Closure;

class MysqlConnectionQuery extends ConnectionQuery
{
    /**
     * @inheritDoc
     */
    abstract public function whereJsonValue(): Closure;

    /**
     * @inheritDoc
     */
    abstract public function whereJsonKeyExists(): Closure;

    /**
     * @inheritDoc
     */
    abstract public function whereJsonIsValid(): Closure;
}