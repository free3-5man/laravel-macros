<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Build URL-encoded http query string.
 *
 * @return string
 */
class BuildQuery
{
    public function __invoke()
    {
        return function (array $array) : string {
            return http_build_query($array);
        };
    }
}
