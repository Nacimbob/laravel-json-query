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

    public static $methodsMapping = [
        'whereJsonExists' => 'whereJsonExists',
        'whereJsonIsValid' => 'whereJsonIsValid',
        'whereJsonValue' => 'whereJsonValue'
    ];

    public function __construct(Connection $connection, ConnectionFactory $connectionFactory)
    {
        $this->connection = $connection;
        $this->query =  $connection->query();
        $this->driver = $connection->getDriverName();
        $this->connectionFactory = $connectionFactory;
    }

    public function extendQueryBuilder(): void
    {
        $connectionQuery = $this->getConnectionQuery();

        foreach (static::$methodsMapping  as $alias => $name) {
            $this->query->macro($alias, $connectionQuery->{$name}());
        }
    }

    private function getConnectionQuery(): ConnectionsConnection
    {
        return $this->connectionFactory->make($this->driver);
    }
}