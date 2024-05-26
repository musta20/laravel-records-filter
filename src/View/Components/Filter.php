<?php

namespace Musta20\LaravelFilter\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public $filterFiled;
    public $realData;
    public $relName;
    public $relType;

    // public function __construct($filterFiled = null, $realData = null, $relName = null, $relType = null)
    // {
    //     $this->filterFiled = $filterFiled;
    //     $this->realData = $realData;
    //     $this->relName = $relName;
    //     $this->relType = $relType;
    // }

    public function render()
    {
        return view('laravelFilter::components.filter');
        // return view('components.filter', [
        //     'filterFiled' => $this->filterFiled,
        //     'realData' => $this->realData,
        //     'relName' => $this->relName,
        //     'relType' => $this->relType
        // ]);
    }
}
