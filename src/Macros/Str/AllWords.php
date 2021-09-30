<?php

namespace Freeman\LaravelMacros\Macros\Str;

/**
 * Converts a given string into an array of words with some pattern.
 *
 * @return array
 */
class AllWords
{
    public function __invoke()
    {
        return function (string $string, string $pattern = '/\w+/') : array {
            preg_match_all($pattern, $string, $matches);

            return $matches[0] ?? [];
        };
    }
}
