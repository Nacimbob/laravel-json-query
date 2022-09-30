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

    protected $methodsMapping = [

    ];

    public function __construct(Connection $connection, )
    {
        $this->query =  $connection->query();
        $this->driver = $connection->getDriverName();
    }

    public function extendQueryBuilder(): void
    {
        foreach ($this->methodsMapping  as $alias => $name) {
            $this->query->macro($alias, $this->{$name}());
        }
    }
}