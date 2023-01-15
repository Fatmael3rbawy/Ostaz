@push('scripts')
<script>

    function changeArea(key)
    {
        // console.log(key.value);
        // console.log('c'+ String(key.value));

        var areaSelect = document.getElementById('areaSelect');

        for (var i = 0; i < areaSelect.length; i++){
            // console.log('c');
            var option = areaSelect.options[i];
            option.setAttribute("hidden", "hidden");
        }

        areas= document.getElementsByClassName('c'+ String(key.value) );
        for (var i = 0; i < areas.length; i++){
            var area_option = areas[i];
            area_option.removeAttribute("hidden");
            // console.log(area_option);
        }
    }
</script>
<script>

    function changeCategory(key)
    {
        

        var subcategorySelect = document.getElementById('subcategorySelect');

        for (var i = 0; i < subcategorySelect.length; i++){
            // console.log('c');
            var option = subcategorySelect.options[i];
            option.setAttribute("hidden", "hidden");
        }

        subCategory= document.getElementsByClassName('subC'+ String(key.value) );
        for (var i = 0; i < subCategory.length; i++){
            var cat_option = subCategory[i];
            cat_option.removeAttribute("hidden");
            // console.log(area_option);
        }
    }
</script>
@endpush