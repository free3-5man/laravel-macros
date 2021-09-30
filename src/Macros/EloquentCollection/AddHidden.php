<?php

namespace Freeman\LaravelMacros\Macros\EloquentCollection;

/**
 * Make the hidden attributes for each model in the collection.
 *
 * @param array|string|null $attributes
 *
 * @mixin Illuminate\Database\Eloquent\Collection
 *
 * @return mixed
 */
class AddHidden
{
    public function __invoke()
    {
        return function ($attributes) {
            /** @var Illuminate\Database\Eloquent\Collection $this */
            return $this->each->makeHidden($attributes);
        };
    }
}
