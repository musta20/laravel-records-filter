<?php

namespace Musta20\LaravelRecordsFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

trait HasFilter
{
    public static function scopeRequestPaginate($query)
    {

        $request = request();

        $limit = $request->limit ?? 10;

        $request->validate([
            'limit' => 'nullable|integer|min:2|max:100',
        ]);

        return $query->paginate($limit);
    }

    public function newEloquentBuilder($query): Builder
    {

        $filterbuilder = new FilterBuilder($query);

        if (method_exists($this, 'sortFilterOptions')) {
            $filterbuilder->setFilterOption(sortFilterOptions: $this->sortFilterOptions());
        }

        if (method_exists($this, 'relationsFilterOptions')) {
            $filterbuilder->setFilterOption(relationsFilterOptions: $this->relationsFilterOptions());
        }

        if (method_exists($this, 'searchFields')) {
            $filterbuilder->setFilterOption(searchFields: $this->searchFields());
        }

        if (method_exists($this, 'filterOptions')) {
            $filterbuilder->setFilterOption(filterOptions: $this->filterOptions());
        }

        return $filterbuilder;
    }

    public function scopeFilter($query)
    {

        $relation = request()->query()['rel'] ?? null;

        $sort = request()->query()['sort'] ?? null;

        $filter = request()->query()['filter'] ?? null;

        $searchTerm = request()->query()['search'] ?? null;

        if ($sort) {

            $sort = json_decode(urldecode($sort[0]));

            $thismodelName = $this->getTable();
            if ($sort) {
                switch ($sort->type) {
                    case 'ASC':
                        $query->orderBy($thismodelName . '.' . $sort->filed);
                        break;
                    case 'DESC':
                        $query->orderBy($thismodelName . '.' . $sort->filed, 'desc');
                        break;
                    default:
                        break;
                }
            }
        }

        if ($filter) {

            $filterOption = collect($this->filterOptions());

            $collectedFilter = collect($filter);

            foreach ($collectedFilter as $key => $value) {

                if (isset($value['operation']) && $value['operation'] == 'between') {

                    $rangeItem = $filterOption->where('filed', $value['filed'])->where('operation', 'between')->first();

                    if ($rangeItem) {

                        if (isset($value[$rangeItem['options'][0]]) && isset($value[$rangeItem['options'][1]])) {

                            $min = min($value[$rangeItem['options'][0]], $value[$rangeItem['options'][1]]);

                            $max = max($value[$rangeItem['options'][0]], $value[$rangeItem['options'][1]]);

                            $query->whereBetween($this->getTable() . '.' . $value['filed'], [$min, $max]);
                        }
                    }
                } elseif (isset($value['value']) && isset($value['filed'])) {

                    $value['operation'] = isset($value['operation']) ? urldecode($value['operation']) : '=';

                    $filteringItem = $filterOption->where('filed', $value['filed'])->first();

                    if ($filteringItem['type'] == 'date') {

                        $query->whereDate($this->getTable() . '.' . $value['filed'], $value['value']);
                    } else {

                        $valCoutn = $collectedFilter->where('filed', $value['filed']);

                        if (count($valCoutn) > 1) {

                            $query->whereIn($this->getTable() . '.' . $value['filed'], $valCoutn->pluck('value')->toArray());

                            continue;
                        }

                        $query->where($this->getTable() . '.' . $value['filed'], $value['operation'], $value['value']);
                    }
                }
            }
        }

        if ($relation) {

            foreach ($relation as $key => $value) {

                $relModelName = collect(self::relationsFilterOptions())->where('id', $value['filed'])->first()['model'];

                $tableName = $this->getModelName($relModelName);

                $currrentModelName = $this->getTable();

                $ModelPrymaryId = $this->getModelKeyName($relModelName);

                $query
                    ->select($currrentModelName . '.*')
                    ->join($tableName, $currrentModelName . '.' . $value['filed'], '=', $tableName . '.' . $ModelPrymaryId)
                    ->where($tableName . '.' . $ModelPrymaryId, $value['value']);
            }
        }

        if ($searchTerm) {
            $currrentModelName = $this->getTable();

            $query->where(function ($query) use ($searchTerm, $currrentModelName) {

                foreach ($this->searchFields() as $columnName) {

                    $searchTerm = urldecode($searchTerm);

                    $query->orWhere($currrentModelName . '.' . $columnName, 'like', "%{$searchTerm}%");
                }
            });
        }

        return $query->RequestPaginate();
    }

    public function getModelName($model)
    {

        $model = App::make($model);

        return $model->getTable();
    }

    public function getModelKeyName($model)
    {

        $model = App::make($model);

        return $model->getKeyName();
    }
}
