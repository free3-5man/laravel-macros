<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Same with push, is a pair of prepend.
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Append
{
    public function __invoke()
    {
        return function ($item) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->push($item);
        };
    }
}
