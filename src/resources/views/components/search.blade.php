<form @if (app()->getLocale() === 'ar')
    dir="rtl"
    @endif

    @submit.prevent="submitFilter"

    id="laravelFilter::search"

    class="relative ">

    <div class="absolute inset-y-0 start-0 rtl:end-10 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
    </div>



    <input type="text" name="search"
        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 "
        placeholder="{{ __('Search') }}">



    @if (app()->getLocale() === 'ar')

    <div class="absolute left-0 inset-y-0   flex items-center ">

        <button
            class="inline-flex items-center text-gray-500 border border-gray-300  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 font-medium rounded-l-lg text-sm px-3 py-2">{{
            __('Search') }}</button>
    </div>

    @else



    <div class="absolute right-0 inset-y-0   flex items-center ">

        <button
            class="inline-flex items-center text-gray-500 border border-gray-300  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 font-medium rounded-r-lg text-sm px-3 py-2">{{
            __('Search') }}</button>
    </div>

    @endif






</form>