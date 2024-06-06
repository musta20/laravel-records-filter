<div class="flex" x-data="{ openMenu: false }">

    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" {{-- @click.outside="openMenu = false" --}}
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

                    <li class="p-2" x-data="{ selected: 0 }">

                        @foreach ($item['options'] as $key=>$optionItem)
                        
                        <div class="mb-3">

                            <input {{-- x-model="FilterForm.filter[{{$arrayIndexCounter}}][filed]" --}}
                                name="filter[{{$arrayIndexCounter}}][filed]" value="{{$item['filed']}}" hidden>

                            <input {{-- x-model="FilterForm.filter[{{$arrayIndexCounter}}][operation]" --}}
                                name="filter[{{$arrayIndexCounter}}][operation]" value="{{$item['operation']}}" hidden>

                            <input {{-- x-model="FilterForm.filter[{{$arrayIndexCounter}}][value]" --}}
                                name="filter[{{$arrayIndexCounter}}][value]"
                                
                                @checked(isset($checkBoxData) && $checkBoxData->where('value', $optionItem)->first())
                              
                                value="{{$optionItem}}" type="checkbox">

                            <label>{{$key}}</label>

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

                        <input name="filter[{{$arrayIndexCounter}}][filed]" value="{{$item['filed']}}" hidden>

                        <select
                            class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            name="filter[{{$arrayIndexCounter}}][value]">

                            <option disabled selected value> -- select an option -- </option>

                            @foreach ($item['options'] as $key=>$SelectItem)
                            <option 
                            @selected(isset($selectData) && $selectData->where('value', $SelectItem)->first())

                            value="{{$SelectItem}}">{{$key}}</option>

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
                    <li class="p-2" x-data="{ selected: 0 }">

                        <input name="filter[{{$arrayIndexCounter}}][filed]" value="{{$item['filed']}}" hidden>

                        @foreach ($item['options'] as $key=>$RadioItem)
                        <input 
                        
                        @checked(isset($radioGroupData) && $radioGroupData->where('value', $RadioItem)->first())

                        type="radio" name="filter[{{$arrayIndexCounter}}][value]" value="{{$RadioItem}}">
                        <label>{{$key}}</label>

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
                    <li class="p-2" x-data="{ selected: 0 }">
                        <label>{{$item['label']}}</label>

                        <input
                            class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            name="filter[{{$arrayIndexCounter}}][value]" 

                            @if(isset($dateData))
                            value="{{$dateData['value']}}"
                            @endif

                            type="date">

                        <input hidden name="filter[{{$arrayIndexCounter}}][operation]" value="{{$item['operation']}}">
                        <input hidden name="filter[{{$arrayIndexCounter}}][filed]" value="{{$item['filed']}}">
                    </li>
                    @break

                    @case('range')
                        @php

                            $rangeData =  $relRequestData->where('filed', $item['filed'])->where('operation','=','between')->first();

                            // dd($dateData);
                        @endphp
                    <li class="p-2" x-data="{ selected: 0 }">
                        <label>{{$item['label']}}</label>

                        <div>
                            <label>{{$item['options'][0]}}</label>

                            <input

                            @if(isset($rangeData) && isset($rangeData[$item['options'][0]]))
                            value="{{$rangeData[$item['options'][0]]}}"
                            @endif

                                class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                name="filter[{{$arrayIndexCounter}}][{{$item['options'][0]}}]" 
                                @if ($item['inputType']==='number' ) type="number" @else type="date" @endif>

                        </div>

                        <div>
                            <label>{{$item['options'][1]}}</label>

                            <input
                            @if(isset($rangeData) && isset($rangeData[$item['options'][1]]))
                            value="{{$rangeData[$item['options'][1]]}}"
                            @endif
                                class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                name="filter[{{$arrayIndexCounter}}][{{$item['options'][1]}}]"
                                 @if ($item['inputType']==='number' ) type="number" @else type="date" @endif>
                        </div>


                        <input hidden name="filter[{{$arrayIndexCounter}}][operation]" value="{{$item['operation']}}">
                        <input hidden name="filter[{{$arrayIndexCounter}}][filed]" value="{{$item['filed']}}">
                    </li>
                    @break
                @default

                @endswitch


                @php
                $arrayIndexCounter++;
                @endphp
                @endforeach

            </ul>
            <button
                class="w-full text-white m-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
                {{__('filter')}}
            </button>
        </form>
    </div>

    {{-- @if (request()->has('filed') || request()->has('search') || request()->has('orderType'))
    <a class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs" href="{{ request()->url() }}">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path
                d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
        </svg>

        <span> {{__('clear filter')}}</span>
    </a>
    @endif --}}



</div>