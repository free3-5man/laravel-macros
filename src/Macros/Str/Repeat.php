<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Initializes and fills an string with the specified value.
 *
 * @return string
 */
class Repeat
{
    public function __invoke()
    {
        return function (string $string, int $times) {
            return str_repeat($string, $times);
        };
    }
}
