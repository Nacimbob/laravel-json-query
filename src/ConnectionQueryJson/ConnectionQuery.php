<?php

namespace QueryJson\ConnectionQueryJson;
use \Illuminate\Database\ConnectionInterface as Connection;
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
    abstract public function whereJsonExists(): Closure;

    /**
     * @return Closure
     */
    abstract public function whereJsonIsValid(): Closure;
}