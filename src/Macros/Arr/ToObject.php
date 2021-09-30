<?php

namespace Freeman\LaravelMacros\Macros\Arr;

use Illuminate\Support\Arr;

/**
 * Convert an assoc array to an object, else null.
 *
 * @return ?object
 */
class ToObject
{
    public function __invoke()
    {
        return function (array $array) : ?object {
            return Arr::isAssoc($array) ? json_decode(json_encode($array)) : null;
        };
    }
}
