<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Reject with regex.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class WhereNotLike
{
    public function __invoke()
    {
        return function (string $field, string $value = null) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->reject(function ($item) use ($field, $value) {
                $pattern = is_null($value) ? "/{$field}/" : "/{$value}/";
                return preg_match($pattern, is_null($value) ? $item : $item[$field]);
            })->values();
        };
    }
}
