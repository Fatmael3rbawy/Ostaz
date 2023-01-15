@push('scripts')
    <script>
        function Check(input) {
            var list=document.getElementsByClassName(input.value);
            for (var i = 0; i < list.length; ++i) {
                if (list[i].checked) {
                    list[i].checked = false
                } else {
                    list[i].checked = "checked"
                }
            }
        }
    </script>
@endpush