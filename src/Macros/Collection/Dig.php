<?php

namespace Freeman\LaravelMacros\Macros\Collection;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Returns the target value in a nested JSON object, based on the given key.
 *
 * @param mixed $callback
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Dig
{
    public function __invoke()
    {
        return function (string $key) {
            /** @var \Illuminate\Support\Collection $this */
            $array = $this->toArray();
            $dot = Arr::dot($array);

            $firstDotKey = collect($dot)->filter(function ($item, $dotKey) use ($key) {
                return in_array($key, explode('.', $dotKey));
            })->sortBy(function($item, $dotKey) use($key) {
                return array_search($key, explode('.', $dotKey));
            })->keys()->first();
            if(isset($firstDotKey))
            {
                $path = Str::before($firstDotKey, $key) . $key;
                /* return collect(explode('.', $path))->reduce(function($carry, $key) use($array) {
                    return $carry[$key] ?? $array[$key];
                }); */
                return Arr::get($array, $path);
            }

            return null;
        };
    }
}
