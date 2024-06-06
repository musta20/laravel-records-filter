<script>
    document.addEventListener("alpine:init", () => {
     Alpine.data("FilterForm", () => ({
         submitFilter: function (removeFilter = null) {
 
             console.log("submit");
 
             const filter = BuildFromFormData("filter");
 
             let sort = BuildFromFormData("sort");
 
             const rel = BuildFromFormData("rel");
 
             const limit = new FormData(document.getElementById("limit"));
 
             let search = new FormData(document.getElementById("search"));
 
             if(removeFilter)
             {
                 switch (removeFilter.type) {
                     case "filter":
                         
                         break;
                     case "sort":
 
                     sort = new FormData();
 
                         break;
                     case "rel":
                         
                         break;
                     case "search":
                     search = new FormData();
                         break;
                     case "limit":
                         
                         break;
                     default:
                         break;
                 }
             }
 
             const merged = mergeFormData(
                 mergeFormData(filter, sort),
                 mergeFormData(rel, mergeFormData(limit, search))
             );
 
 
 
             let query = "";
 
             for (const [key, value] of merged.entries()) {
                 query += `${key}=${encodeURIComponent(value)}&`;
             }
 
             if (query.endsWith("&")) {
                 query = query.slice(0, -1);
             }
 
             const url = new URL(window.location.href);
 
             window.history.pushState({}, "", url.toString());
 
             window.location.href = "?" + encodeURI(query);
 
 
             function mergeFormData(formData1, formData2) {
                 for (const [key, value] of formData2.entries()) {
                     formData1.append(key, value);
                 }
                 return formData1;
             }
 
             function BuildFromFormData(formElement) {
                 const filterElement = document.getElementById(formElement);
                 const formData = new FormData(filterElement);
 
                 let query = "";
 
                 let EaV = getEmptyArrayValues(formData);
 
                 let none = getNoneValueKeys(formData);
 
                 let skip = skipIndexValues(formData);
 
                 const newFormDataEaV = new FormData();
 
                 let merged = [...new Set([...EaV, ...none])];
 
                 merged = merged.filter((item) => !skip.includes(item));
                 for (const [key, value] of formData) {
                     if (!merged.some((evaKey) => key.startsWith(evaKey))) {
                         newFormDataEaV.append(key, value);
                     }
                 }
 
                 return newFormDataEaV;
             }
 
             function skipIndexValues(clonde) {
                 empty = [];
 
                 for (const [key, value] of clonde.entries()) {
                     //if(value=='between') continue;
 
                     if (value === "between") {
                         $itemarray3 = stringToArray(key);
 
                         valindex = $itemarray3[1] + "[" + $itemarray3[0] + "]";
 
                         empty.push(valindex);
                     }
                 }
 
                 empty = [...new Set(empty)];
                 return empty;
             }
 
             function getEmptyArrayValues(clonde) {
                 empty = [];
 
                 for (const [key, value] of clonde.entries()) {
                     //if(value=='between') continue;
 
                     if (value === undefined || value === "") {
                         $itemarray3 = stringToArray(key);
 
                         valindex = $itemarray3[1] + "[" + $itemarray3[0] + "]";
 
                         empty.push(valindex);
                     }
                 }
 
                 empty = [...new Set(empty)];
                 return empty;
             }
 
             function getNoneValueKeys(clonde) {
                 none = [];
 
                 arryKeys = [];
 
                 for (const [key, value] of clonde.entries()) {
                     if (value == "between") continue;
 
                     arryKeys.push(key);
 
                     $itemarray3 = stringToArray(key);
 
                     valindex =
                         $itemarray3[1] + "[" + $itemarray3[0] + "][value]";
 
                     if (!none.includes(valindex)) {
                         none.push(valindex);
                     }
                 }
 
                 arryKeys.forEach((item) => {
                     // console.log(item);
 
                     if (none.includes(item)) {
                         none.splice(none.indexOf(item), 1);
                     }
                 });
 
                 none = none.map((item) => item.replace("[value]", ""));
 
                 return none;
             }
 
             function stringToArray(str) {
                 // This function will need to be implemented based on your specific key structure
                 // For example, assuming your keys are in the format "filter[0]['value']"
                 const parts = str.split(/\[|\]|\'/);
                 let index = undefined;
                 let keyPart = parts[0]; // "filter"
 
                 if (parts.length > 1 && parts[1] !== "") {
                     index = parts[1]; // "0"
                     keyPart += parts[2]; // "filter['value']"
                 }
 
                 return [index, keyPart];
             }
         },
         removeFilter: () => {},
     }));
 });
 
 </script>
 
 <div  x-data="FilterForm">
 
 
 <div
     class="flex  items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4  ">
 
     {{-- pagination per page items --}}
     <x-laravelFilter::paginator :paginator="$paginator" />
 
     {{-- sorting options --}}
     @if ($paginator->relationsFilterOptions)
     <x-laravelFilter::filter :paginator="$paginator" />
     @endif
 
     @if ($paginator->sortFilterOptions)
     <x-laravelFilter::sort-filter :paginator="$paginator" />
     @endif
 
     {{-- relations filter options --}}
     @if ($paginator->relationsFilterOptions)
 
     <x-laravelFilter::relation-filter :paginator="$paginator" />
 
     @endif
 
 
     {{-- search --}}
     <x-laravelFilter::search />
 
 </div>
 
     @if (request('search'))
 
     <x-laravelFilter::tag-filters tag="search" :text="request('search')" />
   
     @endif
       
     @if (request('sort'))
 
         @isset(request('sort')[0])
         @php
 
             $sort = json_decode(urldecode(request('sort')[0]));
 
            $data =  collect($paginator->sortFilterOptions)->where('filed',$sort->filed)->where('type',$sort->type)->first();
           
         @endphp
 
           <x-laravelFilter::tag-filters  tag="sort" :text="$data['lable']" /> 
 
         @endisset
   
     @endif
 
     @if (request('rel'))
 
         @php
 
         $data =  collect($paginator->relationsFilterOptions);
 
         @endphp
 
     @foreach (request('rel') as $item)
 
         @php
 
             $relItem =$data->where('id', $item['filed'])->first();
             
         @endphp
 
         <x-laravelFilter::tag-filters tag="rel" :text="$relItem['label']" />
   
     @endforeach
 
     @endif
 
     {{-- @if (request()->has('filed') || request()->has('search') || request()->has('orderType'))
     <a class="flex pt-2 p-2 rounded-md border mx-2  text-gray-500 text-xs" href="{{ request()->url() }}">
 
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
             <path
                 d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
         </svg>
 
         <span> {{__('clear filter')}}</span>
     </a>
     @endif --}}
 
     {{-- filters tags --}}
 
 </div>