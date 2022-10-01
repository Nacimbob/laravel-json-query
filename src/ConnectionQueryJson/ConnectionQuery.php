<?php

namespace QueryJson\ConnectionQueryJson;
use Closure;

abstract class ConnectionQuery
{
    const BASE_PATH_PREFIX = '$';
    /**
     * @return Closure
     */
    public function whereJsonValue(): Closure
    {
        $columnAndPathResolver = $this->getColumnAndPathResolver();

        $sqlCompiler = $this->{"get". __FUNCTION__ . "Compiler"}();

        return function(string $path, string $operator, $value) use ($columnAndPathResolver, $sqlCompiler) {
            [$column, $path] = $columnAndPathResolver($path);

            $sql = $sqlCompiler($column, $operator);

            return $this->whereRaw($sql, [$path, $value]);
        };
    }

    /**
     * @return Closure
     */
    public function whereJsonExists(): Closure
    {
        $columnAndPathResolver = $this->getColumnAndPathResolver();

        $sqlCompiler = $this->{"get". __FUNCTION__ . "Compiler"}();

        return function(string $path) use ($columnAndPathResolver, $sqlCompiler) {
            [$column, $path] = $columnAndPathResolver($path);

            $sql = $sqlCompiler($column);

            return $this->whereRaw($sql, $path);
        };
    }

    /**
     * @return Closure
     */
    public function whereJsonIsValid(): Closure
    {
        $sqlCompiler = $this->{"get". __FUNCTION__ . "Compiler"}();

        return function(string $column) use($sqlCompiler) {
            return $this->whereRaw($sqlCompiler($column));
        };
    }

    /**
     * @return Closure
     */
    protected function getColumnAndPathResolver(): Closure
    {
        return function(string $path): array {

            $jsonPath = preg_split('#->|(?=(\[))#', $path);

            $column = array_shift($jsonPath);

            $queryPath = array_reduce($jsonPath, function($carry, $subPath) {

                $carry .= $this->getSubPathPrefix($subPath) . $subPath;

                return $carry;
            }, static::BASE_PATH_PREFIX);


            return [$column, $queryPath];
        };
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
     * @return Closure
     */
    abstract protected function getWhereJsonValueCompiler(): Closure;

    /**
     * @return Closure
     */
    abstract protected function getWhereJsonIsValidCompiler(): Closure;

    /**
     * @return Closure
     */
    abstract protected function getWhereJsonExistsCompiler(): Closure;
}