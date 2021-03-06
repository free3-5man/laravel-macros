<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Illuminate\Database\Query\Builder;

/**
 * Add a subquery as a column to the query.
 *
 * @return Builder
 */
class AddSelectSub
{
    public function __invoke()
    {
        return function (string $column, $query) : Builder {
            /** @var Builder $this */
            if (is_null($this->columns))
                $this->select($this->from . '.*');

            $query->limit(1);

            return $this->selectSub($query instanceof Builder ? $query : $query->toSql(), $column);
        };
    }
}
