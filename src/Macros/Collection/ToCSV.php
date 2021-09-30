<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Converts a 2D array to a comma-separated values (CSV) string.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class ToCSV
{
    public function __invoke()
    {
        return function (string $delimiter = ','): string {
            /** @var \Illuminate\Support\Collection $this */
            return $this->map(function (array $line) use ($delimiter) {
                return collect($line)->implode($delimiter);
            })->implode('\n');
        };
    }
}
