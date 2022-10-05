<?php

namespace QueryJson;
use QueryJson\Compilers\QueryCompilerFactory;
use Closure;

class JsonQueryBuilder
{
    private $queryCompilerFactory;

    private $driver;

    public function __construct(QueryCompilerFactory $queryCompilerFactory)
    {
        $this->queryCompilerFactory = $queryCompilerFactory;
    }

    /**
     * @param string $driver
     * @return void
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return callback
     */
    public function whereJsonValue()
    {
        return $this->getWhereJsonValueQuery();
    }

    /**
     * @return callback
     */
    private function getWhereJsonValueQuery($associativity = '')
    {
        $queryCompiler = $this->getQueryCompiler(__FUNCTION__, $associativity);

        return function(string $path, string $operator, $value) use ($queryCompiler, $associativity) {
            [$column, $path] = $queryCompiler[0]->resolveColumnAndPath($path);


            return $this->{$associativity .  'WhereRaw'}(
                call_user_func($queryCompiler, $column, $operator),
                [$path, $value]
            );
        };
    }

    /**
     * @return callback
     */
    public function whereJsonIsValid()
    {
        return $this->getWhereJsonIsValidQuery();
    }

    /**
     * @return callback
     */
    private function getWhereJsonIsValidQuery(string $associativity = '')
    {
        $queryCompiler = $this->getQueryCompiler(__FUNCTION__, $associativity);

        return function(string $column) use($queryCompiler, $associativity) {
            return $this->{$associativity .  'WhereRaw'}(
                call_user_func($queryCompiler, $column),
            );
        };
    }

    /**
     * @return array
     */
    private function getQueryCompiler(string $method, string $associativity): array
    {
        return [
            $this->queryCompilerFactory->make($this->driver),
            $associativity . substr_replace($method, 'Compiler', - 5)
        ];
    }
}