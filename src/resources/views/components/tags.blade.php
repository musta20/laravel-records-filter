<div class="flex flex-wrap	gap-3  border-t border-gray-200 dark:border-gray-700  p-2.5">

    @if (request('search'))

    <x-laravelRecordsFilter::tag-filters tag="search" text="{{ __('laravelRecordsFilter::messages.search').' : '.urldecode(request('search')) }}" />

    @endif

        @if (request('sort'))

            @isset(request('sort')[0])
                @php

                $sort = json_decode(urldecode(request('sort')[0]));

                $data = collect($paginator->sortFilterOptions)->where('filed',$sort->filed)->where('type',$sort->type)->first();

                @endphp

                    <x-laravelRecordsFilter::tag-filters tag="sort" :text="$data['lable']" />

                @endisset

        @endif

    @if (request('rel'))

        @php

        $data = collect($paginator->relationsFilterOptions);

        @endphp

        @foreach (request('rel') as $key=>$item)

            @php

            $relItem =$data->where('id', $item['filed'])->first();

            @endphp


            <x-laravelRecordsFilter::tag-filters index="{{ $key }}"
                tag="rel"
                text="{{ $relItem['label'] .' : '. urldecode($item['label']) }}"

                />


        @endforeach

    @endif

        @if (request('filter'))

            @php

                $data = collect($paginator->filterOptions);

                $collectedFilter = collect(request('filter'));

            @endphp


            @foreach ($collectedFilter as $key=>$item)


        @php

    if(isset($item['operation']) && $item['operation'] == 'between')
        {

            $relItem =$data->where('filed', $item['filed'])->where('type', 'range')->first();

        }
     else
        {

        $relItem =$data->where('filed', $item['filed'])->first();

        }


  @endphp

    @if ( isset($relItem) &&
    isset($item['operation']) &&
    $item['operation'] == 'between' &&
    isset($item[$relItem['options'][0]]) &&
    isset($item[$relItem['options'][1]]))


        <x-laravelRecordsFilter::tag-filters index="{{ $key }}" tag="filter"
            text="{{ $relItem['label'] .' : '.$item[$relItem['options'][0]].' - '.$item[$relItem['options'][1]] }}" />

        @elseif (isset($relItem['options']) && isset($item['value']) && $relItem['type'] != 'range')

        <x-laravelRecordsFilter::tag-filters index="{{ $key }}" tag="filter"
            text="{{ $relItem['label'] .' : '.array_search($item['value'], $relItem['options']) }}" />

        @elseif (isset($relItem['type']) && $relItem['type'] != 'range')


        <x-laravelRecordsFilter::tag-filters index="{{ $key }}" tag="filter"
            text="{{ $relItem['label'] .' : '.urldecode($item['value']) }}" />


        @endif


    @endforeach

    @endif



</div>