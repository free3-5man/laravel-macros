<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * An alias of take.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Limit
{
    public function __invoke()
    {
        return function (int $limit) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->take($limit);
        };
    }
}
