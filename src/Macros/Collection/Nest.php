<?php

namespace Freeman\LaravelMacros\Macros\Collection;

/**
 * Given a flat array of objects linked to one another, it will nest them recursively.
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return mixed
 */
class Nest
{
    public function __invoke()
    {
        return function (string $link, string $key = 'id', string $childrenKey = 'children', $showEmptyArrayWithChildrenKeyWhenDoesntHaveChildren = false) {
            // use & to recursive fallback itself
            $recursiveMap = function (array $node) use ($link, $key, $childrenKey, $showEmptyArrayWithChildrenKeyWhenDoesntHaveChildren, &$recursiveMap) {
                $nodeId = $node[$key];
                /** @var \Illuminate\Support\Collection $this */
                $children = $this->where($link, $nodeId)->values();

                return array_merge($node, $children->count() > 0 ? [
                    $childrenKey => $children->map($recursiveMap)->toArray(),
                ] : ($showEmptyArrayWithChildrenKeyWhenDoesntHaveChildren ? [$childrenKey => []] : []));
            };

            /** @var \Illuminate\Support\Collection $this */
            $roots = $this->whereNull($link)->values();
            return $roots->map(function ($root) use ($recursiveMap) {
                return $recursiveMap($root);
            });
        };
    }
}
