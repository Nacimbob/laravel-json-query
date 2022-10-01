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
        $columnAndPathResolver = $this->getColumnAndPathResolver();

        return function(string $path, $operator,$value) use ($columnAndPathResolver) {
            [$column, $path] = $columnAndPathResolver($path);

            $sql = " json_value($column, ?) $operator ? ";

            return $this->whereRaw($sql, [$path, $value]);
        };
    }

    /**
     * @inheritDoc
     */
    public function whereJsonExists(): Closure
    {
        $columnAndPathResolver = $this->getColumnAndPathResolver();

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
        return function(string $column){
            return $this->whereRaw("json_valid($column)");
        };
    }
}