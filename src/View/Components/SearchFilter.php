<?php

namespace Musta20\LaravelRecordsFilter\View\Components;

use Illuminate\View\Component;

class SearchFilter extends Component
{
    public function __construct(public $paginator)
    {

    }

    public function render()
    {
        return view('laravelRecordsFilter::components.search');

    }
}
