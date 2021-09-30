<?php

namespace Freeman\LaravelMacros;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class MacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        collect($this->eloquentCollectionMacros())
            ->reject(function ($class, $macro) {
                return EloquentCollection::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                EloquentCollection::macro($macro, app($class)());
            });

        collect($this->collectionMacros())
            ->reject(function ($class, $macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                Collection::macro($macro, app($class)());
            });

        collect($this->arrMacros())
            ->reject(function ($class, $macro) {
                return Arr::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                Arr::macro($macro, app($class)());
            });

        collect($this->strMacros())
            ->reject(function ($class, $macro) {
                return Str::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                Str::macro($macro, app($class)());
            });

        collect($this->builderMacros())
            ->reject(function ($class, $macro) {
                return Builder::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                Builder::macro($macro, app($class)());
            });

        collect($this->eloquentBuilderMacros())
            ->reject(function ($class, $macro) {
                return Builder::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                EloquentBuilder::macro($macro, app($class)());
            });

        collect($this->carbonMacros())
            ->reject(function ($class, $macro) {
                return Carbon::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                Carbon::macro($macro, app($class)());
            });
        collect($this->carbonPeriodMacros())
            ->reject(function ($class, $macro) {
                return CarbonPeriod::hasMacro($macro);
            })
            ->each(function ($class, $macro) {
                CarbonPeriod::macro($macro, app($class)());
            });
    }

    private function eloquentCollectionMacros(): array
    {
        return [
            'addAppends' => \Freeman\LaravelMacros\Macros\EloquentCollection\AddAppends::class,
            'addHidden' => \Freeman\LaravelMacros\Macros\EloquentCollection\AddHidden::class,
        ];
    }

    private function collectionMacros(): array
    {
        return [
            'ifAll' => \Freeman\LaravelMacros\Macros\Collection\IfAll::class,
            'ifAny' => \Freeman\LaravelMacros\Macros\Collection\IfAny::class,
            'append' => \Freeman\LaravelMacros\Macros\Collection\Append::class,
            'equals' => \Freeman\LaravelMacros\Macros\Collection\Equals::class,
            'indexOfAll' => \Freeman\LaravelMacros\Macros\Collection\IndexOfAll::class,
            'initial' => \Freeman\LaravelMacros\Macros\Collection\Initial::class,
            'tail' => \Freeman\LaravelMacros\Macros\Collection\Tail::class,
            'limit' => \Freeman\LaravelMacros\Macros\Collection\Limit::class,
            'offset' => \Freeman\LaravelMacros\Macros\Collection\Offset::class,
            'nest' => \Freeman\LaravelMacros\Macros\Collection\Nest::class,
            'toCSV' => \Freeman\LaravelMacros\Macros\Collection\ToCSV::class,
            'whereLike' => \Freeman\LaravelMacros\Macros\Collection\WhereLike::class,
            'whereNotLike' => \Freeman\LaravelMacros\Macros\Collection\WhereNotLike::class,
            'zipWithKeys' => \Freeman\LaravelMacros\Macros\Collection\ZipWithKeys::class,
            'camelCaseKeys' => \Freeman\LaravelMacros\Macros\Collection\CamelCaseKeys::class,
            'kebabCaseKeys' => \Freeman\LaravelMacros\Macros\Collection\KebabCaseKeys::class,
            'snakeCaseKeys' => \Freeman\LaravelMacros\Macros\Collection\SnakeCaseKeys::class,
            'lowerCaseKeys' => \Freeman\LaravelMacros\Macros\Collection\LowerCaseKeys::class,
            'mapKeys' => \Freeman\LaravelMacros\Macros\Collection\MapKeys::class,
            'transformKeys' => \Freeman\LaravelMacros\Macros\Collection\TransformKeys::class,
            'dig' => \Freeman\LaravelMacros\Macros\Collection\Dig::class,
            'mapOnly' => \Freeman\LaravelMacros\Macros\Collection\MapOnly::class,
            'mapExcept' => \Freeman\LaravelMacros\Macros\Collection\MapExcept::class,
            'sortKeysByKeysRanking' => \Freeman\LaravelMacros\Macros\Collection\SortKeysByKeysRanking::class,
        ];
    }

    private function arrMacros(): array
    {
        return [
            'range' => \Freeman\LaravelMacros\Macros\Arr\Range::class,
            'repeat' => \Freeman\LaravelMacros\Macros\Arr\Repeat::class,
            'expand' => \Freeman\LaravelMacros\Macros\Arr\Expand::class,
            'dotOnly' => \Freeman\LaravelMacros\Macros\Arr\DotOnly::class,
            'isAssoc' => \Freeman\LaravelMacros\Macros\Arr\IsAssoc::class,
            'toObject' => \Freeman\LaravelMacros\Macros\Arr\ToObject::class,
            'buildQuery' => \Freeman\LaravelMacros\Macros\Arr\BuildQuery::class,
            'parseQuery' => \Freeman\LaravelMacros\Macros\Arr\ParseQuery::class,
            'isSub' => \Freeman\LaravelMacros\Macros\Arr\IsSub::class,
            'remove' => \Freeman\LaravelMacros\Macros\Arr\Remove::class,
        ];
    }

    private function strMacros(): array
    {
        return [
            'chars' => \Freeman\LaravelMacros\Macros\Str\Chars::class,
            'allWords' => \Freeman\LaravelMacros\Macros\Str\AllWords::class,
            'lines' => \Freeman\LaravelMacros\Macros\Str\Lines::class,

            'each' => \Freeman\LaravelMacros\Macros\Str\Each::class,
            'map' => \Freeman\LaravelMacros\Macros\Str\Map::class,
            'reduce' => \Freeman\LaravelMacros\Macros\Str\Reduce::class,

            'swapCase' => \Freeman\LaravelMacros\Macros\Str\SwapCase::class,
            'capitalize' => \Freeman\LaravelMacros\Macros\Str\Capitalize::class,
            'decapitalize' => \Freeman\LaravelMacros\Macros\Str\Decapitalize::class,
            'humanize' => \Freeman\LaravelMacros\Macros\Str\Humanize::class,

            'reverse' => \Freeman\LaravelMacros\Macros\Str\Reverse::class,
            'repeat' => \Freeman\LaravelMacros\Macros\Str\Repeat::class,
            'mask' => \Freeman\LaravelMacros\Macros\Str\Mask::class,
        ];
    }

    private function builderMacros(): array
    {
        return [
            'addSelectSub' => \Freeman\LaravelMacros\Macros\Builder\AddSelectSub::class,
            'filter' => \Freeman\LaravelMacros\Macros\Builder\Filter::class,
            'filterRange' => \Freeman\LaravelMacros\Macros\Builder\FilterRange::class,
            'filterWhereNull' => \Freeman\LaravelMacros\Macros\Builder\FilterWhereNull::class,
            'overlaps' => \Freeman\LaravelMacros\Macros\Builder\Overlaps::class,
        ];
    }

    private function eloquentBuilderMacros(): array
    {
        return [
            'getFullSql' => \Freeman\LaravelMacros\Macros\EloquentBuilder\GetFullSql::class,
            'dumpSql' => \Freeman\LaravelMacros\Macros\EloquentBuilder\DumpSql::class,

            'enhancedPaginate' => \Freeman\LaravelMacros\Macros\EloquentBuilder\EnhancedPaginate::class,
        ];
    }

    private function carbonMacros(): array
    {
        return [
            'getNaturalWeeks' => \Freeman\LaravelMacros\Macros\Carbon\GetNaturalWeeks::class,
        ];
    }

    private function carbonPeriodMacros(): array
    {
        return [
            'countWeeks' => \Freeman\LaravelMacros\Macros\CarbonPeriod\CountWeeks::class,
        ];
    }
}
