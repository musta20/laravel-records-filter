<form id="sort" method="get">

        <select name="sort[]"  @change="submitFilter()"

            class="inline-flex items-center text-gray-500 border border-gray-500 w-36  dark:border-gray-500 dark:text-gray-500 dark:bg-gray-800  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"

            >

            {{ __('filter') }}:

            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>

            <!-- Dropdown menu -->
            @if (!request()->has('sort'))

            <option disabled selected value> sort filter : </option>

            @endif

            @foreach ($paginator->sortFilterOptions as $item)

            @php
            $sortValue = json_encode(['filed'=>$item['filed'],'type'=>$item['type']]);
            @endphp

            <option @if (request()->has('sort') && $sortValue==urldecode(request()->get('sort')[0]))
                selected
                @endif
                value="{{ $sortValue }}"
                >
                {{ $item['lable'] }}

            </option>

            @endforeach

        </select>

    </form>


