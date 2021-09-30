<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * First do high-order map, then except keys for each item.
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class MapExcept
{
    public function __invoke()
    {
        return function (array $keys) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->map(function ($item) use ($keys) {
                return collect(method_exists($item, 'toArray') ? $item->toArray() : (array) $item)->except($keys);
            });
        };
    }
}
