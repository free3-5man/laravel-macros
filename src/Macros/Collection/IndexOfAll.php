<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Returns all indices of value in the array. If value never occurs, returns [].
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class IndexOfAll
{
    public function __invoke()
    {
        return function ($value, bool $strict = false) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->filter(function ($item, $key) use ($value, $strict) {
                return $strict ? $item === $value : $item == $value;
            })->keys()->all();
        };
    }
}
