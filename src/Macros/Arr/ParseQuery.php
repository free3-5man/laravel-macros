<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Parse the URL-encoded query string to array.
 *
 * @return array
 */
class ParseQuery
{
    public function __invoke()
    {
        return function (string $string) : array {
            parse_str($string, $array);
            return $array;
        };
    }
}
