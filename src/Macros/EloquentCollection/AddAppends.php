<?php

namespace Freeman\LaravelMacros\Macros\EloquentCollection;

/**
 * Append attributes for each model in the collection.
 *
 * @param array|string  $attributes
 *
 * @mixin Illuminate\Database\Eloquent\Collection
 *
 * @return mixed
 */
class AddAppends
{
    public function __invoke()
    {
        return function ($attributes) {
            /** @var Illuminate\Database\Eloquent\Collection $this */
            return $this->each->append($attributes);
        };
    }
}
