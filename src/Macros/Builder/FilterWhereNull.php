<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Illuminate\Database\Query\Builder;

/**
 * Filter using whereNull with the request input data or specified data.
 *
 * @return Builder
 */
class FilterWhereNull
{
    public function __invoke()
    {
        return function (array $whereFields, ?array $data = null) : Builder {
            $data = $data ?: request()->input();

            foreach ($whereFields as $table => $fields) {
                foreach ($fields as $tableField => $requestField) {
                    // if $tableField is integer, it is the case table field equals to request field
                    // zh-cn: 如果是整数，说明是自然的数组index，则表字段和请求字段同一
                    $tableField = is_int($tableField) ? $requestField : $tableField;

                    // use ?field=&... to represent whereNull(field)
                    $value = data_get($data, $requestField);
                    /** @var Builder $this */
                    $this->when(array_key_exists($requestField, $data) && is_null($value), function ($query) use ($table, $tableField) {
                        return $query->whereNull("{$table}.{$tableField}");
                    });
                }
            }

            return $this;
        };
    }
}
