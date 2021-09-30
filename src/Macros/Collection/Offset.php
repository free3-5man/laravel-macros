<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * An alias of skip.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Offset
{
    public function __invoke()
    {
        return function (int $offset) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->skip($offset);
        };
    }
}
