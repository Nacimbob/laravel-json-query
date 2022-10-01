<?php

namespace QueryJson\ConnectionQueryJson;
use \Illuminate\Database\ConnectionInterface as Connection;
use Closure;

abstract class ConnectionQuery
{
    const BASE_PATH_PREFIX = '$';
    /**
     * @return Closure
     */
    abstract public function whereJsonValue(): Closure;

    /**
     * @return Closure
     */
    abstract public function whereJsonExists(): Closure;

    /**
     * @return Closure
     */
    abstract public function whereJsonIsValid(): Closure;

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
}