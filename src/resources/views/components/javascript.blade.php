<script>
  document.addEventListener("alpine:init", () => {
  Alpine.data("FilterForm", () => ({
    submitFilter: function (removeFilter = null) {
      let query = "";

      let filter = BuildFromFormData("laravelFilter::filter");

      let sort = BuildFromFormData("laravelFilter::sort");

      let rel = BuildFromFormData("laravelFilter::rel");

      let limitElement = document.getElementById("laravelFilter::limit");
      const limit = !limitElement ? new FormData() : new FormData(limitElement);

      let searchElement = document.getElementById("laravelFilter::search");

      let search = !searchElement
        ? new FormData()
        : new FormData(searchElement);

      // remove filters
      if (removeFilter) {
        switch (removeFilter.type) {
          case "filter":
            indexToRemove = "filter[" + removeFilter.index + "]";

            let newrFilter = new FormData();

            for (const [key, value] of filter) {
              if (!key.startsWith(indexToRemove)) {
                newrFilter.append(key, value);
              }
            }
            filter = newrFilter;
            break;
          case "sort":
            sort = new FormData();

            break;
          case "rel":
            indexToRemove = "rel[" + removeFilter.index + "]";

            let newrel = new FormData();

            for (const [key, value] of rel) {
              if (!key.startsWith(indexToRemove)) {
                newrel.append(key, value);
              }
            }
            rel = newrel;
            break;
          case "search":
            search = new FormData();
            break;

          default:
            break;
        }
      }

      //merge all the forms data
      const merged = mergeFormData(
        mergeFormData(filter, sort),
        mergeFormData(rel, mergeFormData(limit, search))
      );

      // build the url from all the data in the forms
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

        if (!filterElement) return new FormData();

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
            if (formElement == "laravelFilter::rel" && key.includes("[value]")) {
              relItemOption = JSON.parse(value);

              ItemIndex = stringToArray(key);

              fulllabelIndex = ItemIndex[1] + "[" + ItemIndex[0] + "][label]";

              newFormDataEaV.append(key, relItemOption.id);
              newFormDataEaV.append(fulllabelIndex, relItemOption.label);

              continue;
            }

            newFormDataEaV.append(key, value);
          }
        }

        return newFormDataEaV;
      }

      function skipIndexValues(clonde) {
        empty = [];

        for (const [key, value] of clonde.entries()) {
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

          valindex = $itemarray3[1] + "[" + $itemarray3[0] + "][value]";

          if (!none.includes(valindex)) {
            none.push(valindex);
          }
        }

        arryKeys.forEach((item) => {
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
  }));
});

</script>
<style>
  :where([dir="rtl"]) select {
    background-position: left .5rem center;
  }
</style>