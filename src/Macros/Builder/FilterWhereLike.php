<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Illuminate\Database\Query\Builder;

/**
 * Filter using whereNull with the request input data or specified data.
 *
 * @return Builder
 */
class FilterWhereLike
{
    public function __invoke()
    {
        return function (array $whereFields, ?array $data = null): Builder {
            $data = $data ?: request()->input();

            /** @var Builder $this */
            return $this->where(function ($query) use ($whereFields, $data) {
                // 多个 $table 之间是 or 的关系
                foreach ($whereFields as $table => $fields) {
                    foreach (collect($fields)->groupBy(fn ($item) => $item, $preserveKeys = true) as $requestField => $assoc) {
                        if (isset($data[$requestField])) {
                            $clue = $data[$requestField];
                            /** @var Builder $this */
                            $query->orWhere(function ($query) use ($assoc, $table, $clue) {
                                foreach ($assoc as $tableField => $requestField) {
                                    $tableField = is_int($tableField) ? $requestField : $tableField;
                                    $query->orWhere("{$table}.{$tableField}", 'ilike', "%{$clue}%");
                                }
                            });
                        }
                    }
                }
            });
        };
    }
}
