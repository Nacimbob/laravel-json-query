<?php

namespace QueryJson;

use \Illuminate\Database\ConnectionInterface as Connection;
use QueryJson\Connections\Connection as ConnectionsConnection;
use QueryJson\Connections\ConnectionFactory;

class QueryJsonManager
{
    /**
     * @var Illuminate\Database\Query
     */
    private $query;

    /**
     * @var string
     */
    private $driver;

    private $connectionFactory;

    public function __construct(Connection $connection, ConnectionFactory $connectionFactory)
    {
        $this->connection = $connection;
        $this->query =  $connection->query();
        $this->driver = $connection->getDriverName();
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @return void
     */
    public function extendQueryBuilder(): void
    {
        $connectionQuery = $this->getConnectionQuery();

        foreach (get_class_methods($connectionQuery) as $name) {
            $this->query->macro($name, $connectionQuery->{$name}());
        }
    }

    /**
     * @return ConnectionsConnection
     */
    private function getConnectionQuery(): ConnectionsConnection
    {
        return $this->connectionFactory->make($this->driver);
    }
}