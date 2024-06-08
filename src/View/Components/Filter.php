<?php

namespace Musta20\LaravelFilter\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public function __construct(public $paginator, public $postForm=null)
    {
    }

    public function render()
    {
        return view('laravelFilter::components.filter-option');
    }
}
