<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Illuminate\Database\Query\Builder;

/**
 * Filter using where or whereDate with the ranged request input data or specified data.
 *
 * @return Builder
 */
class FilterRange
{
    public function __invoke()
    {
        return function (array $whereRangeFields, bool $useWhereDate = false, ?array $data = null, string $surfixBegin = '_begin', string $surfixEnd = '_end') : Builder {
            $where = $useWhereDate ? 'whereDate' : 'where';

            $data = $data ?: request()->input();

            foreach ($whereRangeFields as $table => $fields) {
                foreach ($fields as $tableField => $requestField) {
                    // if $tableField is integer, it is the case table field equals to request field
                    // zh-cn: 如果是整数，说明是自然的数组index，则表字段和请求字段同一
                    $tableField = is_int($tableField) ? $requestField : $tableField;

                    /** @var Builder $this */
                    // use isset but not empty in when, cause empty has problem with value 0(bool or int)
                    $this->when(isset($data["{$requestField}{$surfixBegin}"]), function ($query) use ($where, $data, $tableField, $requestField, $table, $surfixBegin) {
                        return $query->{$where}("{$table}.{$tableField}", '>=', $data["{$requestField}{$surfixBegin}"]);
                    })->when(isset($data["{$requestField}{$surfixEnd}"]), function ($query) use ($where, $data, $tableField, $requestField, $table, $surfixEnd) {
                        return $query->{$where}("{$table}.{$tableField}", '<=', $data["{$requestField}{$surfixEnd}"]);
                    });
                }
            }

            return $this;
        };
    }
}
