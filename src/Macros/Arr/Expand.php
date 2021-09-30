<?php

namespace Freeman\LaravelMacros\Macros\Arr;

/**
 * Expand the flattened dot key array to multi-dimensional array.
 * Has the reverse effect with the existing method Arr::dot($array).
 *
 * @return string
 */
class Expand
{
    public function __invoke()
    {
        return function (array $array, $separator = '.') {
            $result = [];
            foreach ($array as $key => $value) {
                $dotKeys = explode($separator, $key);
                $item = [];
                for ($i = count($dotKeys) - 1; $i >= 0; $i--) {
                    if ($i === count($dotKeys) - 1)
                    $item[$dotKeys[$i]] = $value;
                    else
                        $item = [$dotKeys[$i] => $item];
                }
                $result = array_merge_recursive($result, $item);
            }

            return $result;
        };
    }
}
