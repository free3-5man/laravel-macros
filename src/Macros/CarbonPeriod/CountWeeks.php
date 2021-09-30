<?php

namespace Freeman\LaravelMacros\Macros\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

/**
 * Count natural weeks in a period, just same as calculate the sundays count.
 * Assume monday is a week start while sunday is a week end.
 *
 * @return string
 */
class CountWeeks
{
    public function __invoke()
    {
        return function () : int {
            /** @var CarbonPeriod $this */
            $this->start;

            $start = $this->getStartDate()->startOfDay();
            $end = $this->getEndDate()->startOfDay();

            $countSundays = $start->diffInDaysFiltered(function (Carbon $date) {
                return $date->isSunday();
            }, $end);

            return $countSundays + 1;
        };
    }
}
