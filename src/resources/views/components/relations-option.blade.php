<form @submit.prevent="submitFilter" id="laravelFilter::rel" method="get">
    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownActionButton">

        @php

        $arrayIndexCounter = 0;

        if (request()->has('rel')){

            $relRequestData = collect(request()->get('rel'));
        }

        @endphp

        @foreach ($relationsFilterOptions as $item)

        <li class="p-2">


                <label
                class="block bg-slate-500 p-2 dark:bg-slate-600 mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                >{{ $item['label'] }}</label>

                <input value="{{ $item['id'] }}" name="rel[{{ $arrayIndexCounter }}][filed]" hidden>

                <select

                    name="rel[{{ $arrayIndexCounter }}][value]"

                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">

                    <option disabled
                        @if (!isset($relRequestData) || !$relRequestData->contains('filed', $item['id']))
                        selected
                        @endif value>
                            {{ __('laravelRecordsFilter::messages.select an option') }}
                    </option>


                    @foreach ($item['data'] as $option)
                    <option

                    @if (isset($relRequestData) && $relRequestData->where('filed', $item['id'])->where('value', $option->id)->first())

                        selected

                    @endif
                        value="{{ json_encode([
                            "id" => $option[$option->getKeyName()],
                            "label" => $option[$item['label_filed']]
                            ]) }}">

                        {{ $option[$item['label_filed']] }}

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
        {{ __('laravelRecordsFilter::messages.filter') }}
    </button>
</form>
