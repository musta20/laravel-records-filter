<?php

namespace Musta20\LaravelFilter\View\Components;

use Illuminate\View\Component;

class SortFilter extends Component
{   public function __construct(public $paginator)
    {
    
    }
 
    public function render()
    {
        return view('laravelFilter::components.sort-filter');
    }
}
