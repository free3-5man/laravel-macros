<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Returns the capitalized string.
 *
 * @return string
 */
class Capitalize
{
    public function __invoke()
    {
        return function (string $string, bool $allWords = false) {
            return $allWords ? ucwords($string) : ucfirst($string);
        };
    }
}
