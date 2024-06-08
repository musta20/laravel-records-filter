<x-laravelRecordsFilter::javascript />


<div x-data="FilterForm">


        @if ($paginator->filterOptions)

        <x-laravelRecordsFilter::filter :paginator="$paginator" />

        @endif


    {{-- relations filter options --}}
    @if ($paginator->relationsFilterOptions)

    <x-laravelRecordsFilter::relation-filter :paginator="$paginator" />

    @endif


</div>