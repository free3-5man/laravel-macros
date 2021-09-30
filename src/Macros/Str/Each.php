<?php

namespace Freeman\LaravelMacros\Macros\Str;

use Illuminate\Support\Str;
/**
 * Just like collection each.
 */
class Each
{
    public function __invoke()
    {
        return function (string $string, $callback = null) {
            return collect(Str::chars($string))->each($callback);
        };
    }
}
