<div class="flex" x-data="{ openMenu: false }">

    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" @click="openMenu = ! openMenu"
        class="inline-flex items-center text-gray-500 border dark:border-gray-500 border-gray-300  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
        type="button">
        {{ __('Relations') }}
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>



    <div x-cloak x-show="openMenu" id="dropdownAction"
    class="z-10 mt-10 absolute bg-white divide-y dark:bg-gray-800 divide-gray-100 rounded-lg shadow w-auto  ">

        <form @submit.prevent="submitFilter" id="rel" method="get">
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">

                @php

                $arrayIndexCounter = 0;

                if (request()->has('rel')){

                    $relRequestData = collect(request()->get('rel'));
                }

                @endphp

                @foreach ($relationsFilterOptions as $item)

                <li class="p-2">


                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item['label'] }}</label>

                        <input value="{{ $item['id'] }}" name="rel[{{ $arrayIndexCounter }}][filed]" hidden>

                        <select

                            name="rel[{{ $arrayIndexCounter }}][value]"

                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option disabled
                                @if (!isset($relRequestData) || !$relRequestData->contains('filed', $item['id']))
                                selected
                                @endif value>
                                    -- select an option --
                            </option>


                            @foreach ($item['data'] as $option)
                            <option

                            @if (isset($relRequestData) && $relRequestData->where('filed', $item['id'])->where('value', $option->id)->first())

                                selected

                            @endif

                                value="{{ json_encode(["id" => $option->id, "label" => $option->name]) }}">

                                {{ $option->name }}

                            </option>
                            @php
                            $arrayIndexCounter++;
                            @endphp
                            @endforeach
                        </select>



                </li>
                @php
                $arrayIndexCounter++;
                @endphp
                @endforeach
            </ul>
            <button
                class=" text-white m-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
                {{ __('filter') }}
            </button>
        </form>
    </div>
</div>