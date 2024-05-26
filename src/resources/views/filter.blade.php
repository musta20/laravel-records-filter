<div class="flex  items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">
   
    <div class="flex" x-data="{ openMenu: false }">
        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
            class="inline-flex items-center text-gray-500 border border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
            type="button">

            show  :
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
        </button>




        <!-- Dropdown menu -->
        <div x-cloak x-show="openMenu" id="dropdownAction"
            class="z-10 mt-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-30  ">
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
                @foreach ([5,10,20,30,40,50] as $item)
                <li>

                    <a href="{{$paginator->buildUri(['itemsPerPage'=>$item])}}" class="block px-4 py-2 hover:bg-gray-100  ">
                       per page {{$item}}
                    </a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>


    <div class="flex" x-data="{ openMenu: false }">
        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
            class="inline-flex items-center text-gray-500 border border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
            type="button">
            صنف حسب:
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>




        <!-- Dropdown menu -->
        <div x-cloak x-show="openMenu" id="dropdownAction"
            class="z-10 mt-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44  ">
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
               @if ($paginator->filterFiled)
                   
                @foreach ($paginator->filterFiled as $item)
                <li>
                    <a href="{{$paginator->buildUri(['filed'=>$item['name'],'orderType'=>$item['orderType'],'value'=>$item['value']])}}"
                        class="block px-4 py-2 hover:bg-gray-100  ">
                        {{$item['lable']}}
                    </a>
                </li>
                @endforeach
                @endif

            </ul>

        </div>

        @if (request()->has('filed') || request()->has('search') || request()->has('orderType'))
        <a class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs" href="{{ request()->url() }}">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                <path
                    d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
            </svg>

            <span> إلغاء التصفية</span>
        </a>
        @endif



    </div>




    @if ($paginator->realData)

    <div class="flex" x-data="{ openMenu: false }">
        <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
            class="inline-flex items-center text-gray-500 border border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
            type="button">
            <span class="sr-only">Action button</span>
            صنف حسب: {{ $relName ?? '' }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>




        <!-- Dropdown menu -->
        <div x-cloak x-show="openMenu" id="dropdownAction"
            class="z-10 mt-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44  ">
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
                @foreach ($paginator->realData as $item)
                <li>
                    <a href="{{$paginator->buildUri(['rel'=>$relType,'id'=>$item->id])}}"
                        class="block px-4 py-2 hover:bg-gray-100  ">
                        {{$item->name ?? $item->title}}
                    </a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
    @endif


    @if ($paginator->realData)


    <div class="flex gap-1">

        @if (request()->has('rel') && request()->has('id'))
        <span class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mx-1">
                <path
                    d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
            </svg>

            {{ $paginator->realData->find(request('id'))->name ?? $paginator->realData->find(request('id'))->title }}

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
        @if ($paginator->filterFiled)
        @foreach ($paginator->filterFiled as $item)
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
        @endforeach
        @endif

    </div>
    @endif

    <label for="table-search" dir="ltr" class="sr-only">بحث</label>
    <form method="GET" action="{{ request()->fullUrlWithQuery(request()->query()) }}" class="relative ">
        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="text" name="search"
            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
            placeholder="بحث">
        <div class="absolute rtl:!left-0 inset-y-0   flex items-center ps-3 ">

            <button
                class="  inline-flex items-center text-gray-500 border border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-l-lg text-sm px-3 py-2">بحث</button>
        </div>
    </form>
</div>