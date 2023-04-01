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
                $tablesCount = count(array_keys($whereFields));
                $fnBuildOrQuery = function (Builder $query, array $assoc, string $table, string $clue) {
                    foreach ($assoc as $tableField => $requestField) {
                        $tableField = is_int($tableField) ? $requestField : $tableField;
                        $query->orWhere("{$table}.{$tableField}", 'ilike', "%{$clue}%");
                    }
                };

                foreach ($whereFields as $table => $fields) {
                    foreach (collect($fields)->groupBy(fn ($item) => $item, $preserveKeys = true)->toArray() as $requestField => $assoc) {
                        if (isset($data[$requestField])) {
                            $clue = $data[$requestField];
                            if ($tablesCount > 1)
                                $query->orWhere(function ($query) use ($fnBuildOrQuery, $assoc, $table, $clue) {
                                    $fnBuildOrQuery($query, $assoc, $table, $clue);
                                });
                            else
                                $fnBuildOrQuery($query, $assoc, $table, $clue);
                        }
                    }
                }
            });
        };
    }
}
