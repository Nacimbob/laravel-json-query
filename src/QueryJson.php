<?php

namespace QueryJson;

use \Illuminate\Database\ConnectionInterface as Connection;
class QueryJson
{
    /**
     * @var Illuminate\Database\Query
     */
    private $query;

    /**
     * @var string
     */
    private $driver;

    private $connectionQueryFactory;

    public static $methodsMapping = [
        'whereJsonExists' => 'whereJsonExists',
        'whereJsonIsValid' => 'whereJsonIsValid',
        'whereJsonValue' => 'whereJsonValue'
    ];

    public function __construct(Connection $connection, ConnectionQueryFactory $connectionQueryFactory)
    {
        $this->connection = $connection;
        $this->query =  $connection->query();
        $this->driver = $connection->getDriverName();
        $this->connectionQueryFactory = $connectionQueryFactory;
    }

    public function extendQueryBuilder(): void
    {
        $connectionQuery = $this->getConnectionQuery();

        foreach (static::$methodsMapping  as $alias => $name) {
            $this->query->macro($alias, $connectionQuery->{$name}());
        }
    }

    private function getConnectionQuery()
    {
        return $this->connectionQueryFactory->make($this->driver);
    }
}