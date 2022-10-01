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
                "`" . array_shift($path) . "`",
                "$". implode('.', $path),
            ];
        };

        return function(string $path) use ($columnAndPathResolver) {
            [$column, $path] = $columnAndPathResolver($path);

            $sql = " json_exists($column, ?) ";

            return $this->whereRaw($sql, $path);
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