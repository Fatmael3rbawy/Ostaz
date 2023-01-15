<script>
    $(document).ready(function() {
        $('select[name="city_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('get_areas') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="area_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="area_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
  
            } else {
                console.log('AJAX load did not work');
            }
  
        });
  
    });
  
  </script>
  