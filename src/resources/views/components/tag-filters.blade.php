@props(['tag','text'=>null,'index'=>null])


<span class="flex justify-between w-auto p-1 rounded-md border text-gray-500 dark:border-gray-500 border:gray-300 text-xs">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mx-1">
        <path
            d="M14 2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2.172a2 2 0 0 0 .586 1.414l2.828 2.828A2 2 0 0 1 6 9.828v4.363a.5.5 0 0 0 .724.447l2.17-1.085A2 2 0 0 0 10 11.763V9.829a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 0 14 4.172V2Z" />
    </svg>

    {{ $text ? $text : urldecode(request($tag)) }}
    <button
    @isset($index)
    @click="submitFilter({type:'{{ $tag }}',index:{{ $index }}})"
    @else
    @click="submitFilter({type:'{{ $tag }}'})"

    @endisset

>        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path
                d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
        </svg>
    </button>


</span>


