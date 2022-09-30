<?php

namespace QueryJson\ConnectionQueryJson;

use Closure;

abstract class ConnectionQuery
{
    /**
     * @return Closure
     */
    abstract public function whereJsonValue(): Closure;

    /**
     * @return Closure
     */
    abstract public function whereJsonKeyExists(): Closure;

    /**
     * @return Closure
     */
    abstract public function whereJsonIsValid(): Closure;
}