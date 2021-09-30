<?php

namespace Freeman\LaravelMacros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Converts an underscored, camelized, or dasherized string into a humanized one. Also removes beginning and ending whitespace.
 *
 * @return string
 */
class Humanize
{
    public function __invoke()
    {
        return function (string $string) : string {
            return Str::of($string)->trim()->kebab()->replaceMatches('/_+|-+/', ' ')->ucfirst();
        };
    }
}
