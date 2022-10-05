<?php

namespace QueryJson\Compilers;

use Illuminate\Contracts\Container\Container;

class QueryCompilerFactory
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function make(string $name): QueryCompiler
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
        $abstract = explode('\\', QueryCompiler::class);

        $abstract[]  = ucfirst($name) . array_pop($abstract);

        return implode('\\', $abstract);
    }
}