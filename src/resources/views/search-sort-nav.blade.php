<div x-data="FilterForm">

        <div class="flex gap-3 justify-between flex-wrap">

                {{-- search --}}
                <x-laravelRecordsFilter::search />

                {{-- pagination per page items --}}
                <x-laravelRecordsFilter::paginator :paginator="$paginator" />

                {{-- sorting options --}}
                @if ($paginator->sortFilterOptions)

                <x-laravelRecordsFilter::sort-filter :paginator="$paginator" />

                @endif

        </div>

        <div class="p-2">

                <x-laravelRecordsFilter::tags :paginator="$paginator" />

        </div>


</div>