<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Returns an array of the string’s character.
 *
 * @return array
 */
class Chars
{
    public function __invoke()
    {
        return function (string $string) : array {
            return str_split($string);
        };
    }
}
