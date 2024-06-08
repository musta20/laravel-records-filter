<x-laravelFilter::javascript />


<div x-data="FilterForm">

    {{-- <x-laravelFilter::tags :paginator="$paginator" /> --}}

    @if ($paginator->filterOptions)

    <x-laravelFilter::filter :paginator="$paginator" />

    @endif


    {{-- relations filter options --}}
    @if ($paginator->relationsFilterOptions)

    <x-laravelFilter::relation-filter :paginator="$paginator" />

    @endif


</div>