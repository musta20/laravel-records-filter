{{-- <div class="flex" x-data="{ openMenu: false }">

    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
        @click="openMenu = ! openMenu"
        class="inline-flex items-center text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
        type="button">
        {{ __('filter') }}:
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button> --}}

    <!-- Dropdown menu -->
    {{-- <div x-cloak x-show="openMenu" id="dropdownAction"
        class="z-10 mt-10 absolute bg-white divide-y dark:bg-gray-800 divide-gray-100 rounded-lg shadow w-auto  "> --}}
        <form
         @submit.prevent="submitFilter()" id="filter" method="get">

            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">

                @php

                $arrayIndexCounter = 0;

                $relRequestData = collect(request()->get('filter'));

                @endphp

                @foreach ($paginator->filterOptions as $item)

                @switch($item['type'])

                    @case('checkbox')

                        @php

                            $checkBoxData =  $relRequestData->where('filed', $item['filed']);

                        @endphp

                        <li class="p-2" >
                            <label  class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $item['label'] }}
                            </label>
                            @foreach ($item['options'] as $key=>$optionItem)

                            <div class="flex items-center mb-4">



                                <input  type="checkbox"
                                value="{{ $optionItem }}"
                                @checked(isset($checkBoxData) && $checkBoxData->where('value', $optionItem)->first())

                                name="filter[{{ $arrayIndexCounter }}][value]"

                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                <label  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $key }}</label>

                                <input
                                    name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}" hidden>

                                <input
                                    name="filter[{{ $arrayIndexCounter }}][operation]" value="{{ $item['operation'] }}" hidden>





                            </div>

                            @php
                            $arrayIndexCounter++;
                            @endphp

                            @endforeach

                        </li>
                    @break

                    @case('select')
                        @php

                            $selectData =  $relRequestData->where('filed', $item['filed']);

                        @endphp
                        <li class="p-2">
                            <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item['label'] }}</label>

                            <input name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}" hidden>

                            <select

                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="filter[{{ $arrayIndexCounter }}][value]">

                                <option disabled selected value> -- select an option -- </option>

                                @foreach ($item['options'] as $key=>$SelectItem)
                                <option
                                @selected(isset($selectData) && $selectData->where('value', $SelectItem)->first())

                                value="{{ $SelectItem }}">{{ $key }}</option>

                                @endforeach

                                @php
                                $arrayIndexCounter++;
                                @endphp


                            </select>
                        </li>
                    @break

                    @case('radio group')
                        @php

                            $radioGroupData =  $relRequestData->where('filed', $item['filed']);

                        @endphp
                        <li class="p-2" >

                                <input name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}" hidden>

                                <label class="ms-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item['label'] }}</label>

                                @foreach ($item['options'] as $key=>$RadioItem)
                                <div class="flex items-center mb-4">

                                <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @checked(isset($radioGroupData) && $radioGroupData->where('value', $RadioItem)->first())

                                type="radio" name="filter[{{ $arrayIndexCounter }}][value]" value="{{ $RadioItem }}">


                                <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $key }}</label>

                            </div>

                                @endforeach
                                @php
                                $arrayIndexCounter++;
                                @endphp


                        </li>
                        @break

                    @case('date')

                        @php
                            $dateData =  $relRequestData->where('filed', $item['filed'])->where('operation','!=','between')->first();
                        @endphp

                        <li class="p-2">

                            <div class="mb-6">
                                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item['label'] }}</label>
                                <input
                                name="filter[{{ $arrayIndexCounter }}][value]"

                                @if (isset($dateData))
                                value="{{ $dateData['value'] }}"
                                @endif
                                type="date"
                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <input hidden name="filter[{{ $arrayIndexCounter }}][operation]" value="{{ $item['operation'] }}">
                            <input hidden name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}">
                        </li>
                    @break

                    @case('range')

                        @php

                            $rangeData =  $relRequestData->where('filed', $item['filed'])->where('operation','=','between')->first();

                        @endphp

                        <li class="p-2">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >{{ $item['label'] }}</label>

                            <div class="mb-6">
                                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item['options'][0] }}</label>
                                <input
                                @if (isset($rangeData) && isset($rangeData[$item['options'][0]]))
                                value="{{ $rangeData[$item['options'][0]] }}"
                                @endif


                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                name="filter[{{ $arrayIndexCounter }}][{{ $item['options'][0] }}]"
                                @if ($item['inputType']==='number' ) type="number" @else type="date" @endif>
                            </div>


                            <div class="mb-6">
                                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item['options'][0] }}</label>
                                <input
                                @if (isset($rangeData) && isset($rangeData[$item['options'][1]]))
                                value="{{ $rangeData[$item['options'][1]] }}"
                                @endif


                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                                name="filter[{{ $arrayIndexCounter }}][{{ $item['options'][1] }}]"
                                @if ($item['inputType']==='number' ) type="number" @else type="date" @endif>

                            </div>

                            <input hidden name="filter[{{ $arrayIndexCounter }}][operation]" value="{{ $item['operation'] }}">
                            <input hidden name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}">
                        </li>
                    @break
                @default

                @endswitch


                @php
                $arrayIndexCounter++;
                @endphp
                @endforeach

            </ul>
            @if ($postForm)
            <button
                class=" text-white m-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
                {{ __('filter') }}
            </button>
            @endif
        </form>

    {{-- </div>


</div> --}}