<?php

namespace Musta20\LaravelRecordsFilter\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class RelationFilter extends Component
{
    public $relationsFilterOptions = [];

    public function __construct(public $paginator)
    {
        $this->getModelData($paginator->relationsFilterOptions);
    }

    public function getModelData($relationsFilterOptionsData)
    {
        foreach ($relationsFilterOptionsData as $item) {

            $model = App::make($item['model']);

            $item['data'] = $model::all();

            $this->relationsFilterOptions[] = $item;
        }
    }

    public function render()
    {
        return view('laravelRecordsFilter::components.relations-option');
    }
}
