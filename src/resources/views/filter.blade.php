<div class="flex  items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">



    {{-- pagination per page items --}}
    <x-laravelFilter::paginator :paginator="$paginator" />

    {{-- sorting options --}}
    @if ($paginator->relationsFilterOptions)
    <x-laravelFilter::filter :paginator="$paginator" />
    @endif

    @if ($paginator->sortFilterOptions)
    <x-laravelFilter::sort-filter :paginator="$paginator" />
    @endif

    {{-- relations filter options --}}
    @if ($paginator->relationsFilterOptions)

    <x-laravelFilter::relation-filter :paginator="$paginator" />

    @endif

    {{-- filters tags --}}
    @if ($paginator->relationsFilterOptions)
    <div class="flex gap-1">

        @if (request()->has('rel') && request()->has('id'))
        <span class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mx-1">
                <path
                    d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
            </svg>

            {{ $paginator->relationsFilterOptions->find(request('id'))->name ??
            $paginator->relationsFilterOptions->find(request('id'))->title }}

            <a href="{{ removeVale(['id','rel']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path
                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
            </a>


        </span>
        @endif



        @if (request()->has('search') )
        <span class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mx-1">
                <path
                    d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
            </svg>

            {{ request('search') }}

            <a href="{{  $paginator->removeVale(['search']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path
                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
            </a>


        </span>

        @endif

        @if ($paginator->filterOptions)
        {{-- @foreach ($paginator->filterOptions as $item)
        @if(request()->input('value') === (string) $item['value'])
        <span class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mx-1">
                <path
                    d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
            </svg>
            {{ $item['lable'] }}
            <a href="{{  $paginator->removeVale(['value','orderType','filed']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path
                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                </svg>
            </a>
        </span>
        @endif
        @endforeach --}}
        @endif

    </div>
    @endif

    {{-- search --}}
    <x-laravelFilter::search />

</div>