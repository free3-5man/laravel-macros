<?php

namespace Freeman\LaravelMacros\Macros\Arr;

use Illuminate\Support\Arr;

/**
 * Remove an element or elements from array.
 *
 * @return array
 */
class Remove
{
    public function __invoke()
    {
        return function (array $array, $element) : array {
            return array_values(array_diff($array, Arr::wrap($element)));
        };
    }
}
