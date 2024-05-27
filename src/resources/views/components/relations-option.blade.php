<div class="flex" x-data="{ openMenu: false }">

    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
        class="inline-flex items-center text-gray-500 border border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
        type="button">
        {{__('Relations')}}
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>




    <!-- Dropdown menu -->
    <div x-cloak x-show="openMenu" id="dropdownAction"
        class="z-10 mt-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-50  ">
        <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
            @foreach ($relationsFilterOptions as $item)
            <li>
                <div class="block px-4 py-2 hover:bg-gray-100" >
                    <label>{{$item['label']}}</label>
                    <select 
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "

                    >
                        @foreach ($item['data'] as $option)
                        <option value="{{$option->id}}">{{$option->name}}</option>
                        @endforeach
                    </select>


                </div>
                {{-- <a href="{{$paginator->buildUri(['rel'=>$relType,'id'=>$item->id])}}"
                    class="block px-4 py-2 hover:bg-gray-100  ">
                    {{$item->name ?? $item->title}}
                </a> --}}
            </li>
            @endforeach
        </ul>

    </div>
</div>
