<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Judge an array is subset of another array.
 *
 * @return bool
 */
class IsSub
{
    public function __invoke()
    {
        return function (array $subArray, array $array) : bool {
            return $subArray == array_intersect($subArray, $array);
        };
    }
}
