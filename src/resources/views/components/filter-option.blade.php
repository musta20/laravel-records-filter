<div class="flex" x-data="{ openMenu: false }">

    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" 
    {{-- @click.outside="openMenu = false" --}}
        @click="openMenu = ! openMenu"
        class="inline-flex items-center text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
        type="button">
        {{__('filter')}}:
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
            @foreach ($paginator->filterOptions as $item)

            @switch($item['type'])
            @case('checkbox')
            <li class="p-2" x-data="{ selected: 0 }">
                @foreach ($item['options'] as $key=>$item)

                <div class="mb-3" >
                <input @onselect="selected = $item" name="{{$key}}" value="{{$item}}" type="checkbox">
                <label >{{$key}}</label>

                </div>
                @endforeach

                {{-- <a href="{{$paginator->buildUri(['filed'=>$item['name'],'orderType'=>$item['orderType'],'value'=>$item['value']])}}"
                    class="block px-4 py-2 hover:bg-gray-100  ">
                    {{$item['lable']}}
                </a> --}}
            </li>
            @break
            @case('select')

            @break
            @case('radio group')

            @break
            @case('date')
            <li class="p-2" x-data="{ selected: 0 }">
                <label >{{$item['label']}}</label>
                <input 
                class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                name="{{$item['filed']}}" type="date">
                <input hidden name="operation" value="{{$item['operation']}}">
            </li>
            @break

            @case('between')

            @break
            @default

            @endswitch

            {{-- <li>
                <a href="{{$paginator->buildUri(['filed'=>$item['name'],'orderType'=>$item['orderType'],'value'=>$item['value']])}}"
                    class="block px-4 py-2 hover:bg-gray-100  ">
                    {{$item['lable']}}
                </a>
            </li> --}}


            @endforeach

        </ul>

    </div>

    @if (request()->has('filed') || request()->has('search') || request()->has('orderType'))
    <a class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs" href="{{ request()->url() }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path
                d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
        </svg>

        <span> {{__('clear filter')}}</span>
    </a>
    @endif



</div>