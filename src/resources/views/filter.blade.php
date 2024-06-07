<x-laravelFilter::javascript />

<div x-data="FilterForm">

    <div class="flex  items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">

        {{-- pagination per page items --}}
        <x-laravelFilter::paginator :paginator="$paginator" />

        {{-- sorting options --}}
        @if ($paginator->filterOptions)

        <x-laravelFilter::filter :paginator="$paginator" />

        @endif

        @if ($paginator->sortFilterOptions)

        <x-laravelFilter::sort-filter :paginator="$paginator" />

        @endif

        {{-- relations filter options --}}
        @if ($paginator->relationsFilterOptions)

        <x-laravelFilter::relation-filter :paginator="$paginator" />

        @endif


        {{-- search --}}
        <x-laravelFilter::search />

    </div>

    <x-laravelFilter::tags :paginator="$paginator" />


</div>