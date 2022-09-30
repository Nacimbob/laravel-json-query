<?php

namespace QueryJson;

use \Illuminate\Database\ConnectionInterface as Connection;

class QueryJson
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}