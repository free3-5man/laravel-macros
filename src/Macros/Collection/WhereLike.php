<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Filter with regex.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class WhereLike
{
    public function __invoke()
    {
        return function (string $field, string $value = null) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->filter(function ($item) use ($field, $value) {
                $pattern = is_null($value) ? "/{$field}/" : "/{$value}/";
                return preg_match($pattern, is_null($value) ? $item : $item[$field]);
            })->values();
        };
    }
}
