<?php

namespace Musta20\LaravelRecordsFilter\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public function __construct(public $paginator, public $postForm = null) {}

    public function render()
    {
        return view('laravelRecordsFilter::components.filter-option');
    }
}
