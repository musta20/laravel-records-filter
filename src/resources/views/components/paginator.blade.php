<div class="flex" x-data="{ openMenu: false }">

<button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click.outside="openMenu = false"
    @click="openMenu = ! openMenu"
    class="inline-flex items-center text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
    type="button">

    {{__('show')}} :
    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</button>




<!-- Dropdown menu -->
<div x-cloak x-show="openMenu" id="dropdownAction"
    class="z-10 mt-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-30  ">
    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">
        @foreach ([5,10,20,30,40,50] as $item)
        <li>

            <a href="{{$paginator->buildUri(['itemsPerPage'=>$item])}}" class="block px-4 py-2 hover:bg-gray-100  ">
                {{__('per page')}} {{$item}}
            </a>
        </li>
        @endforeach
    </ul>

</div>
</div>