<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Checks if the collection is equal to the given value.
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Equals
{
    public function __invoke()
    {
        return function ($value) {
            /** @var \Illuminate\Support\Collection $this */
            if ($value instanceof \Illuminate\Support\Collection)
                return $this->toArray() == $value->toArray();

            return $this->toArray() == $value;
        };
    }
}
