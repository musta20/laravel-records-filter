<x-laravelRecordsFilter::javascript />

<div x-data="FilterForm">

    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">

        {{-- pagination per page items --}}
        <x-laravelRecordsFilter::paginator :paginator="$paginator" />

        {{-- sorting options --}}
        @if ($paginator->filterOptions)
        <div class="flex" x-data="{ openMenu: false }">

            <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
                class="inline-flex items-center text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                type="button">
                {{ __('laravelRecordsFilter::messages.filter') }}:
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>


            <div x-cloak x-show="openMenu" id="dropdownAction"
                class="z-10 mt-10 absolute bg-white divide-y dark:bg-gray-800 divide-gray-100 rounded-lg shadow w-auto  ">
                <x-laravelRecordsFilter::filter :postForm="true" :paginator="$paginator" />

            </div>


        </div>
        @endif

        @if ($paginator->sortFilterOptions)

            <x-laravelRecordsFilter::sort-filter :paginator="$paginator" />

        @endif

        {{-- relations filter options --}}
        @if ($paginator->relationsFilterOptions)

            <div class="flex" x-data="{ openMenuRel: false }">

                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenuRel = ! openMenuRel"
                    class="inline-flex items-center text-gray-500 border dark:border-gray-500 border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                    type="button">
                    {{ __('laravelRecordsFilter::messages.filter by') }} :
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div x-cloak x-show="openMenuRel" id="dropdownAction"
                    class="z-10 mt-10 absolute bg-white divide-y dark:bg-gray-800 divide-gray-100 rounded-lg shadow w-auto  ">

                    <x-laravelRecordsFilter::relation-filter :paginator="$paginator" />


                </div>
            </div>
        @endif

        {{-- search --}}
        <x-laravelRecordsFilter::search />

    </div>

    <x-laravelRecordsFilter::tags :paginator="$paginator" />


</div>