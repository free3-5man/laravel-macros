<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Given an array of valid property identifiers and an array of values, return an object associating the properties to the values.
 * Similar but not same with collection method: combine.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class ZipWithKeys
{
    public function __invoke()
    {
        /**
         * @param  mixed  ...$items
         */
        return function ($items) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->zip($items)
                ->filter(function ($item) {
                    return $item[0];
                })
                ->mapWithKeys(function ($item) {
                    return [
                        $item[0] => $item[1],
                    ];
                });
        };
    }
}
