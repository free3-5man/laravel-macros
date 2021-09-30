<?php

namespace Freeman\LaravelMacros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Reverses the string.
 *
 * @return string
 */
class Reverse
{
    public function __invoke()
    {
        return function (string $string) {
            return collect(Str::chars($string))->reverse()->implode('');
        };
    }
}
