<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Returns only the specified key / value pairs from a deeply nested array using "dot" notation.
 *
 * @return string
 */
class DotOnly
{
    public function __invoke()
    {
        return function (array $array, array $keys) : array {
            $data = [];
            foreach ($keys as $key) {
                data_fill($data, $key, data_get($array, $key));
            }

            return $data;
        };
    }
}
