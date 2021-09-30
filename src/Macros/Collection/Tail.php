<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Returns all the elements of an array except the first one.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Tail
{
    public function __invoke()
    {
        return function () {
            /** @var \Illuminate\Support\Collection $this */
            return tap($this)->shift();
        };
    }
}
