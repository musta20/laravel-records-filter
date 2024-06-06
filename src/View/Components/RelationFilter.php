<?php

namespace Musta20\LaravelFilter\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\App;

class RelationFilter extends Component
{
public $relationsFilterOptions =[];
    public function getModelData($relationsFilterOptionsData)
    {
        foreach ($relationsFilterOptionsData as $item) {
           
                $model = App::make($item['model']);

                $item['data'] = $model::all();

            $this->relationsFilterOptions [] = $item;
        }
    }
    public function __construct(public $paginator)
    {
        $this->getModelData($paginator->relationsFilterOptions);
    }
    public function render()
    {
        return view('laravelFilter::components.relations-option');
    }
}
