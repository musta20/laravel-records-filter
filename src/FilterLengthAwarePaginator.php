<?php

namespace Musta20\LaravelRecordsFilter;

use Illuminate\Pagination\LengthAwarePaginator;

class FilterLengthAwarePaginator extends LengthAwarePaginator
{
    public static $defaultFilterView = 'laravelRecordsFilter::simple-filter';

    public $sortFilterOptions = null;
    public $relationsFilterOptions = null;
    public $searchFields = null;
    public $filterOptions = null;

    public function __construct($items, $total, $perPage, $currentPage, array $options, $sortFilterOptions, $relationsFilterOptions, $searchFields, $filterOptions)
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);

        if ($sortFilterOptions) {
            $this->sortFilterOptions = $sortFilterOptions;
        }

        if ($relationsFilterOptions) {
            $this->relationsFilterOptions = $relationsFilterOptions;
        }

        if ($searchFields) {
            $this->searchFields = $searchFields;
        }

        if ($filterOptions) {
            $this->filterOptions = $filterOptions;
        }
    }

    public function filterLinks($view = null, $data = [])
    {
        return $this->renderFilter($view, $data);
    }

    public function filterNav($data = [])
    {
        return $this->renderFilter('laravelRecordsFilter::search-sort-nav', $data);
    }

    /**
     * Render the paginator using the given view.
     *
     * @param  string|null  $view
     * @param  array  $data
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    public function renderFilter($view = null, $data = [])
    {
        return static::viewFactory()->make($view ?: static::$defaultFilterView, array_merge($data, [
            'paginator' => $this,
        ]));

    }
}
