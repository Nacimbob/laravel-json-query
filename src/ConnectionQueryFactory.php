<?php

namespace QueryJson;
use Illuminate\Contracts\Container\Container;
use QueryJson\ConnectionQueryJson\ConnectionQuery;

class ConnectionQueryFactory
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function make(string $name): ConnectionQuery
    {
        $concrete = $this->getConcreteClassName($name);

        return $this->container->make($concrete);
    }

    /**
     * @param string $name
     * @return string
     */
    private function getConcreteClassName(string $name): string
    {
        $abstract = explode('\\', ConnectionQuery::class);

        $abstract[]  = ucfirst($name) . array_pop($abstract);

        return implode('\\', $abstract);
    }
}