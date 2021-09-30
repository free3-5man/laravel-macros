<?php

namespace Freeman\LaravelMacros\Macros\EloquentBuilder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Dump sql with bindings.
 */
class DumpSql
{
    public function __invoke()
    {
        return function () {
            /** @var Builder $this */
            dump($this->getFullSql());
        };
    }
}
