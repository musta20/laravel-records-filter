<x-laravelRecordsFilter::javascript />


<div x-data="FilterForm">

    <div x-data="{ openMenuFilter: false }"
        class="flex  items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">

        <div>
            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                @click="openMenuFilter = ! openMenuFilter"
                class="inline-flex items-center text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                type="button">
                {{ __('laravelRecordsFilter::messages.filter') }}:
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-cloak x-show="openMenuFilter" id="dropdownAction"
                class=" z-10 mt-3 shadow-lg dark:shadow-gray-400  absolute bg-white  dark:bg-gray-800 divide-gray-100 rounded-lg    ">

                @if ($paginator->filterOptions)

                <x-laravelRecordsFilter::filter :paginator="$paginator" />

                @endif



                {{-- relations filter options --}}
                @if ($paginator->relationsFilterOptions)

                <x-laravelRecordsFilter::relation-filter :paginator="$paginator" />

                @endif

            </div>

        </div>

        <div class="flex gap-3">
            {{-- sorting options --}}
            @if ($paginator->sortFilterOptions)

            <x-laravelRecordsFilter::sort-filter :paginator="$paginator" />

            @endif

            {{-- pagination per page items --}}
            <x-laravelRecordsFilter::paginator :paginator="$paginator" />



            @if ($paginator->searchFields)

            {{-- search --}}
            <x-laravelRecordsFilter::search />

            @endif
        </div>
    </div>



</div>