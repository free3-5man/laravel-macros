<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Map only keys, values unchanged.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class MapKeys
{
    public function __invoke()
    {
        /**
         * @param  mixed  ...$items
         */
        return function ($callback) {
            /** @var \Illuminate\Support\Collection $this */
            $keys = $this->keys()->map($callback);

            return $keys->combine($this->items);
        };
    }
}
