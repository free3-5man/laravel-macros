<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Sort the collection by the keys ranking.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class SortKeysByKeysRanking
{
    public function __invoke()
    {
        /**
         * @param array $keysRanking
         */
        return function (array $keysRanking) {
            /** @var \Illuminate\Support\Collection $this */
            return $this->sortBy(function ($item, $key) use($keysRanking) {
                return $keysRanking[$key] ?? PHP_INT_MAX;
            });
        };
    }
}
