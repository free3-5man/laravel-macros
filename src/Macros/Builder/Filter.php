<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Illuminate\Database\Query\Builder;

/**
 * Filter using whereIn or where with the request input data or specified data.
 *
 * @return Builder
 */
class Filter
{
    public function __invoke()
    {
        return function (array $whereFields, bool $useWhereIn = false, ?array $data = null) : Builder {
            $where = $useWhereIn ? 'whereIn' : 'where';

            $data = $data ?: request()->input();

            foreach ($whereFields as $table => $fields) {
                // $tableField is the field of table, $requestField is the request query field
                // zh-cn:$tableField是数据表字段，$requestField是前端交互请求的字段
                foreach ($fields as $tableField => $requestField) {
                    // if $tableField is integer, it is the case table field equals to request field
                    // zh-cn:如果是整数，说明是自然的数组index，则表字段和请求字段同一
                    $tableField = is_int($tableField) ? $requestField : $tableField;

                    $value = data_get($data, $requestField);
                    $condition = true;
                    if (!isset($value))
                        $condition = false;
                    elseif (is_array($value)) {
                        // array_filter is used to filter the request query case like '?a[]='
                        // zh-cn下面的 array_filter 过滤了前端传参为 ?a[]= 的情况，即 request($field) 为 [0 => null] 的情况
                        $condition = !empty(array_filter($value, function ($item) {
                            return !is_null($item);
                        }));
                    }

                    /** @var Builder $this */
                    $this->when($condition, function ($query) use ($where, $tableField, $table, $value) {
                        return $query->{$where}("{$table}.{$tableField}", $value);
                    });
                };
            };

            return $this;
        };
    }
}
