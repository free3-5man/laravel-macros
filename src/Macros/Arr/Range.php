<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Initializes an array containing the numbers in the specified range where start and end are inclusive with there common difference step.
 *
 * @return string
 */
class Range
{
    public function __invoke()
    {
        return function (int $end, int $start = 0, int $step = 1) {
            return range($start, $end, $step);
        };
    }
}
