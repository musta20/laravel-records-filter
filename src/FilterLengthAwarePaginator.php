<?php

namespace Musta20\LaravelFilter;

use Illuminate\Pagination\LengthAwarePaginator;



class FilterLengthAwarePaginator  extends LengthAwarePaginator
{

    public $sortFilterOptions = null;
    public $relationsFilterOptions = null;
    public $searchFields = null;
    public $filterOptions = null;

    public function testLinks()
    {
        return $this->renderFilter();
    }


    function __construct($items, $total, $perPage, $currentPage = null, array $options = [], $sortFilterOptions, $relationsFilterOptions, $searchFields, $filterOptions)
    {
        parent::__construct($items, $total, $perPage, $currentPage,  $options);

        if ($sortFilterOptions) $this->sortFilterOptions = $sortFilterOptions;

        if ($relationsFilterOptions) $this->relationsFilterOptions = $relationsFilterOptions;

        if ($searchFields) $this->searchFields = $searchFields;

        if ($filterOptions) $this->filterOptions = $filterOptions;
    }

    public function buildUri($param)
    {

        $queryParams = request()->query();

        $newuri = url()->current();

        foreach ($param as $key => $value) {

            unset($queryParams[$key]);
        }

        $newuri = $newuri . '?' . http_build_query($queryParams);

        foreach ($param as $key => $value) {

            $newuri = $newuri . '&' . $key . '=' . $value;
        }

        return $newuri;
    }

    public  function removeVale($param)
    {

        $queryParams = request()->query();

        foreach ($param as $value) {

            unset($queryParams[$value]);
        }

        return url()->current() . '?' . http_build_query($queryParams);
    }

    public static $defaultFilterView = 'laravelFilter::filter';
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
