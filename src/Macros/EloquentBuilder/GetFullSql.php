<?php

namespace Freeman\LaravelMacros\Macros\EloquentBuilder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Get full sql string with bindings.
 */
class GetFullSql
{
    public function __invoke()
    {
        return function () : string {
            /** @var Builder $this */
            $sql = $this->toSql();
            foreach ($this->getBindings() as $binding) {
                $value = is_numeric($binding) ? $binding : "'$binding'";
                $sql = preg_replace('/\?/', $value, $sql, 1);
            }

            return $sql;
        };
    }
}
