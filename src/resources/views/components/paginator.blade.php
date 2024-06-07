<form
id="limit"
class="flex" >

<select
name="limit" x-cloak
@change="submitFilter()"
class="inline-flex w-32 items-center dark:bg-gray-800 dark:border-gray-500 text-gray-500 border border-gray-500  focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
    type="button">

    {{ __('show') }} :
    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>


    @foreach ([10,20,30,40,50] as $item)
    <option

    @if (request()->has('limit') && request()->get('limit')==$item)
    selected
    @endif

    value="{{ $item }}">

            {{ __('per page') }} {{ $item }}
    </option>
    @endforeach

</select>


</form>