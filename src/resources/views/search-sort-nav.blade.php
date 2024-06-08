<div x-data="FilterForm">

        <div class="flex gap-3 justify-between flex-wrap">

                {{-- search --}}
                <x-laravelFilter::search />

                {{-- pagination per page items --}}
                <x-laravelFilter::paginator :paginator="$paginator" />

                {{-- sorting options --}}
                @if ($paginator->sortFilterOptions)

                <x-laravelFilter::sort-filter :paginator="$paginator" />

                @endif

        </div>

        <div class="p-2" >
        <x-laravelFilter::tags :paginator="$paginator" />
        </div>


</div>