<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Transform only keys, values unchanged.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class TransformKeys
{
    public function __invoke()
    {
        /**
         * @param  mixed  ...$items
         */
        return function ($callback) {
            /** @var \Illuminate\Support\Collection $this */
            $keys = $this->keys()->map($callback);

            $items = $keys->combine($this->items)->toArray();
            $this->items = $items;

            return $this;
        };
    }
}
