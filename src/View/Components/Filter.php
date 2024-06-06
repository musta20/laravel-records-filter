<?php

namespace Musta20\LaravelFilter\View\Components;

use Illuminate\View\Component;
use Musta20\LaravelFilter\FilterLengthAwarePaginator;
class Filter extends Component
{

    public function __construct(public $paginator)
    {}

    public function render()
    {
        return view('laravelFilter::components.filter-option');
    }
}
