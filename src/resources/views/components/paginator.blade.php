<form id="laravelFilter::limit">

    <select name="limit" x-cloak @change="submitFilter()"
        class="inline-flex items-center text-gray-500 border border-gray-500 w-36  dark:border-gray-500 dark:text-gray-500 dark:bg-gray-800  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 font-medium rounded-lg text-sm px-3 py-1.5"

       >

        {{ __('laravelRecordsFilter::messages.show') }} :
        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>


        @foreach ([10,20,30,40,50] as $item)
        <option @if (request()->has('limit') && request()->get('limit')==$item)
            selected
            @endif

            value="{{ $item }}">

            {{ __('laravelRecordsFilter::messages.per page') }} {{ $item }}
        </option>
        @endforeach

    </select>


</form>