<form id="laravelFilter::sort" method="get">
        <select name="sort[]"  @change="submitFilter()"
        
            class="inline-flex items-center text-gray-500 border border-gray-500 w-36  dark:border-gray-500 dark:text-gray-500 dark:bg-gray-800 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 font-medium rounded-lg text-sm px-3 py-1.5"

            >

            <!-- Dropdown menu -->
            @if (!request()->has('sort'))

            <option disabled selected value> {{ __('sort filter') }} : </option>

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


