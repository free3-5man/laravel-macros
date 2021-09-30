<?php

namespace Freeman\LaravelMacros\Macros\Collection;

use Illuminate\Support\Str;

/**
 * Creates a new array from the specified assoc array, where all the keys are in camel-case.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class LowerCaseKeys
{
    public function __invoke()
    {
        return function () {
            /** @var \Illuminate\Support\Collection $this */
            return $this->keys()->map(function(string $item) {
                return Str::lower($item);
            })->combine($this->items);
        };
    }
}
