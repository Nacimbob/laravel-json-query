<?php

namespace QueryJson\Connections;

use Illuminate\Contracts\Container\Container;

class ConnectionFactory
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function make(string $name): Connection
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
        $abstract = explode('\\', Connection::class);

        $abstract[]  = ucfirst($name) . array_pop($abstract);

        return implode('\\', $abstract);
    }
}