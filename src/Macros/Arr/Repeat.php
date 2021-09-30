<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Initializes and fills an array with the specified value.
 *
 * @return string
 */
class Repeat
{
    public function __invoke()
    {
        return function (int $times, $item) {
            return array_map(function($value) use($item) {
                return $item;
            }, range(1, $times));
        };
    }
}
