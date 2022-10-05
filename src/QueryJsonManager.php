<?php

namespace QueryJson;

use \Illuminate\Database\ConnectionInterface as Connection;
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

    /**
     * @var JsonQueryBuilder
     */
    private $JsonQueryBuilder;

    public function __construct(Connection $connection, JsonQueryBuilder $JsonQueryBuilder)
    {
        $this->connection = $connection;
        $this->query =  $connection->query();
        $this->driver = $connection->getDriverName();
        $this->JsonQueryBuilder = $JsonQueryBuilder;

        $this->JsonQueryBuilder->setDriver($this->driver);
    }

    /**
     * @return void
     */
    public function extendQueryBuilder(): void
    {
        foreach (get_class_methods($this->JsonQueryBuilder) as $name) {
            if (in_array(strtolower($name), ['setdriver', '__construct'], true)) {
                continue;
            }

            $this->query->macro($name, $this->JsonQueryBuilder->{$name}());
        }
    }
}