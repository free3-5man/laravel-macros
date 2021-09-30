<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Returns all the elements of an array except the last one.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Initial
{
    public function __invoke()
    {
        return function () {
            /** @var \Illuminate\Support\Collection $this */
            return tap($this)->pop();
        };
    }
}
