<?php

namespace QueryJson\ConnectionQueryJson;

use Closure;

class MysqlConnectionQuery extends ConnectionQuery
{
    /**
     * @inheritDoc
     */
    public function whereJsonValue(): Closure
    {
        return function(string $path, string $operator, $value) {

        };
    }

    /**
     * @inheritDoc
     */
    public function whereJsonExists(): Closure
    {
        $columnAndPathResolver = function(string $path): array {
            $path = explode('->', $path);

            return [
                'column' => array_shift($path),
                'path' => "$.". implode('.', $path),
            ];
        };        

        return function(string $path) use ($columnAndPathResolver) {
            $columnAndPath =  $columnAndPathResolver($path);

            $sql = " json_exists(:column, :path) ";

            $this->whereRaw($sql, $columnAndPath);
        };
    }

    /**
     * @inheritDoc
     */
    public function whereJsonIsValid(): Closure
    {
        return function(){};
    }
}