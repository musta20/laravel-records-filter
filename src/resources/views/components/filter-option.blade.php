<form
         @submit.prevent="submitFilter()" id="laravelFilter::filter" method="get">

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
                            <label  class="block bg-slate-500 p-2 rounded-md dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $item['label'] }}
                            </label>
                            @foreach ($item['options'] as $key=>$optionItem)

                            <div class="flex items-center mb-4">



                                <input  type="checkbox"
                                value="{{ $optionItem }}"
                                @checked(isset($checkBoxData) && $checkBoxData->where('value', $optionItem)->first())

                                name="filter[{{ $arrayIndexCounter }}][value]"

                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-700 dark:border-gray-600">

                                    <label  class="block ms-2 text-sm font-medium text-gray-700 dark:text-gray-300"


                                >{{ $key }}</label>

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
                            <label   class="block bg-slate-500 p-2 rounded-md dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['label'] }}</label>

                            <input name="filter[{{ $arrayIndexCounter }}][filed]" value="{{ $item['filed'] }}" hidden>

                            <select

                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                            name="filter[{{ $arrayIndexCounter }}][value]">

                                <option disabled selected value>                                    {{ __('laravelRecordsFilter::messages.select an option') }}
                                </option>

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

                                <label
                                class="block bg-slate-500 p-2 rounded-md dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                                >{{ $item['label'] }}</label>

                                @foreach ($item['options'] as $key=>$RadioItem)
                                <div class="flex items-center mb-4">

                                <input
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300  dark:ring-offset-gray-800 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-700 dark:border-gray-600"
                                @checked(isset($radioGroupData) && $radioGroupData->where('value', $RadioItem)->first())

                                type="radio" name="filter[{{ $arrayIndexCounter }}][value]" value="{{ $RadioItem }}">


                                <label class="block ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $key }}</label>

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
                                <label  class="block bg-slate-500 p-2 rounded-md dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['label'] }}</label>
                                <input
                                name="filter[{{ $arrayIndexCounter }}][value]"

                                @if (isset($dateData))
                                value="{{ $dateData['value'] }}"
                                @endif
                                type="date"
                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
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

                            <label class="block bg-slate-500 p-2 rounded-md dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300" >{{ $item['label'] }}</label>

                            <div class="mb-6">
                                <label  class="block  ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['options'][0] }}</label>
                                <input
                                @if (isset($rangeData) && isset($rangeData[$item['options'][0]]))
                                value="{{ $rangeData[$item['options'][0]] }}"
                                @endif


                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"

                                name="filter[{{ $arrayIndexCounter }}][{{ $item['options'][0] }}]"
                                @if ($item['inputType']==='number' ) type="number" @else type="date" @endif>
                            </div>


                            <div class="mb-6">
                                <label  class="block  ms-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item['options'][0] }}</label>
                                <input
                                @if (isset($rangeData) && isset($rangeData[$item['options'][1]]))
                                value="{{ $rangeData[$item['options'][1]] }}"
                                @endif


                                class="block w-full p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"

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
            @isset($postForm)
            <button
                class=" text-white m-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="submit">
                {{ __('laravelRecordsFilter::messages.filter') }}
            </button>
            @endisset
        </form>

