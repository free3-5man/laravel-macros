<?php

namespace Freeman\LaravelMacros\Macros\Str;

use IntlChar;
use Illuminate\Support\Str;

/**
 * Returns a copy of the string in which all the case-based characters have had their case swapped.
 *
 * @return string
 */
class SwapCase
{
    public function __invoke()
    {
        return function (string $string) {
            return collect(Str::chars($string))->map(function($char) {
                return IntlChar::islower($char) ? Str::upper($char) : Str::lower($char);
            })->implode('');
        };
    }
}
