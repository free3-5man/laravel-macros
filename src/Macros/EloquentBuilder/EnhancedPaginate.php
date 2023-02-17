<?php

namespace Freeman\LaravelMacros\Macros\EloquentBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Enhance the existing paginate method with a map function and a given total number.
 *
 * @return LengthAwarePaginator
 */
class EnhancedPaginate
{
    public function __invoke()
    {
        return function ($perPage = 10, $columns = ['*'], $callbackMap = null, ?int $total = null, $pageName = 'page', $page = null) {
            $page = $page ?: Paginator::resolveCurrentPage($pageName);

            /** @var Builder $this */
            $total = $total ?:
                // TODO to replaced with query to get exact total though query has distinct keyword
                $this->toBase()->getCountForPagination();

            $results = $total ? $this->forPage($page, $perPage)->get($columns) : $this->model->newCollection();

            $paginator = $this->paginator($results, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);

            if(is_null($callbackMap))
                return $paginator;

            // use tap to maitain the same format with $paginator
            // so don't return $paginator->map($callbackMap); here
            return tap($paginator)->map($callbackMap);
            /* return tap($paginator, function ($paginator) use ($callbackMap) {
                $paginator->map($callbackMap);
            }); */
        };
    }
}
