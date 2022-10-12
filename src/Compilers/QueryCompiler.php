<?php

namespace QueryJson\Compilers;
use Closure;

abstract class QueryCompiler
{
    protected const BASE_PATH_PREFIX = '$';

    /**
     * @param string $path
     * @return array
     */
    public function resolveColumnAndPath(string $path): array
    {
        $jsonPath = preg_split('#->|(?=(\[))#', $path);

        $column = array_shift($jsonPath);

        $queryPath = array_reduce($jsonPath, function($carry, $subPath) {

            $carry .= $this->getSubPathPrefix($subPath) . $subPath;

            return $carry;
        }, static::BASE_PATH_PREFIX);


        return [$column, $queryPath];
    }

    /**
     * @param string $subPath
     * @return string
     */
    protected function getSubPathPrefix(string $subPath): string
    {
        if (strpos($subPath, '[') === 0) {
            return '';
        }

        return '.';
    }

    /**
     * @param string $column
     * @param string $operator
     * @return string
     */
    abstract public function getWhereJsonValueCompiler(string $column, string $operator): string;


    /**
     * @param string $column
     * @return string
     */
    abstract public function getWhereJsonIsValidCompiler(string $column): string;

    /**
     * @param string $column
     * @return string
     */
    abstract public function getWhereJsonIsInValidCompiler(string $column): string;

    /**
     * @param string $column
     * @param string|null $as
     * @return string
     */

    abstract public function getSelectJsonValueCompiler(string $column, string $as = null): string;



    /**
     * @param mixed $builder
     * @param string $column
     * @param mixed $key
     * @param mixed $value
     * @return mixed
     */
    abstract public function getWhereJsonSearchTextCompiler($builder, string $column, $key, $value);

}