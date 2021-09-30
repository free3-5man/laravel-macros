<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Judge a var is a assoc array.
 *
 * @return bool
 */
class IsAssoc
{
    public function __invoke()
    {
        return function (array $array) : bool {
            if (!is_array($array) || !$array)
                return false;

            return array_keys($array) !== range(0, count($array) - 1);
        };
    }
}
