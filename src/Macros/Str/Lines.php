<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Splits a multiline string into an array of lines.
 *
 * @return array
 */
class Lines
{
    public function __invoke()
    {
        return function (string $string) : array {
            return preg_split('/\n/', $string);
        };
    }
}
