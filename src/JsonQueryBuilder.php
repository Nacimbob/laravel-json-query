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
    public function orWhereJsonValue()
    {
        return $this->getWhereJsonValueQuery('or');
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
        return $this->getWhereJsonIsValidQuery('');
    }

    /**
     * @return callback
     */
    public function orWhereJsonIsValid()
    {
        return $this->getWhereJsonIsValidQuery('or');
    }

    /**
     * @return callback
     */
    private function getWhereJsonIsValidQuery(string $associativity = '', string $method = null)
    {
        $queryCompiler = $this->getQueryCompiler($method ?? __FUNCTION__);

        return function(string $column) use($queryCompiler, $associativity) {
            return $this->{$associativity .  'WhereRaw'}(
                call_user_func($queryCompiler, $column),
            );
        };
    }

        /**
     * @return callback
     */
    public function whereJsonIsInValid()
    {
        return $this->getWhereJsonIsValidQuery('', 'getWhereJsonIsInValidQuery');
    }

    /**
     * @return callback
     */
    public function orWhereJsonIsInValid()
    {
        return $this->getWhereJsonIsValidQuery('or', 'getWhereJsonIsInValidQuery');
    }

    /**
     * @return array
     */
    private function getQueryCompiler(string $method): array
    {
        return [
            $this->queryCompilerFactory->make($this->driver),
            substr_replace($method, 'Compiler', - 5)
        ];
    }
}