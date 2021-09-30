<?php

namespace Freeman\LaravelMacros\Macros\Builder;

use Carbon\CarbonPeriod;
use Illuminate\Database\Query\Builder;

/**
 * Filter overlaps with the given period.
 *
 * @return Builder
 */
class Overlaps
{
    public function __invoke()
    {
        return function (string $startField, string $endField, CarbonPeriod $period) : Builder {
            /** @var Builder $this */
            return $this->where($startField, '<', $period->getEndDate())->where($endField, '>', $period->getStartDate());
        };
    }
}
