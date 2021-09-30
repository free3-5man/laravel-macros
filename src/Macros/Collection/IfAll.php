<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Returns true if the fallback function returns true for all elements in a collection,false otherwise.
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class IfAll
{
    public function __invoke()
    {
        return function ($callback = null) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->reduce(function ($carry, $item) use ($callback) {
                return $carry && ($callback ? $callback($item) : $item);
            }, true);
        };
    }
}
