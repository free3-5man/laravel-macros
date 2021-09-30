<?php

namespace Freeman\LaravelMacros\Macros\Str;

use Illuminate\Support\Str;
/**
 * Just like collection map.
 *
 * @return string
 */
class Map
{
    public function __invoke()
    {
        return function (string $string, $callback = null) {
            return collect(Str::chars($string))->map($callback)->implode('');
        };
    }
}
