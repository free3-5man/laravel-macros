<?php

namespace Freeman\LaravelMacros\Macros\Str;

use Illuminate\Support\Str;
/**
 * Just like collection reduce.
 *
 * @return string
 */
class Reduce
{
    public function __invoke()
    {
        return function (string $string, $callback = null) {
            return collect(Str::chars($string))->reduce($callback);
        };
    }
}
