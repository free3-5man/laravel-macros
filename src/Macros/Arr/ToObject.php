<?php

namespace Freeman\LaravelMacros\Macros\Arr;

use Illuminate\Support\Arr;
use stdClass;

/**
 * Convert an assoc array to an object, else null.
 *
 * @return ?stdClass
 */
class ToObject
{
    public function __invoke()
    {
        return function (array $array) : ?stdClass {
            return Arr::isAssoc($array) ? json_decode(json_encode($array)) : null;
        };
    }
}
