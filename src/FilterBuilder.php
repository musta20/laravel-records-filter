<?php

declare(strict_types=1);

namespace Musta20\LaravelRecordsFilter;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;

class FilterBuilder extends Builder
{
    public $sortFilterOptions = null;
    public $relationsFilterOptions = null;
    public $searchFields = null;
    public $filterOptions = null;

    public function setFilterOption($sortFilterOptions = null, $relationsFilterOptions = null, $searchFields = null, $filterOptions = null)
    {

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

    protected function paginator($items, $total, $perPage, $currentPage, $options)
    {

        $sortFilterOptions = $this->sortFilterOptions;
        $relationsFilterOptions = $this->relationsFilterOptions;
        $searchFields = $this->searchFields;
        $filterOptions = $this->filterOptions;

        return Container::getInstance()->makeWith(FilterLengthAwarePaginator::class, compact(
            'items',
            'total',
            'perPage',
            'currentPage',
            'options',
            'sortFilterOptions',
            'relationsFilterOptions',
            'searchFields',
            'filterOptions'
        ));
    }
}
