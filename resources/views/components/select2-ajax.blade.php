<script>
    $(document).ready(function () {
        $('#{{$id}}').select2({
            language: "fr",
            dropdownParent: $('#{{$id}}').parent(),
            minimumInputLength: {{$length}},
            multiple: {{$multiple}},
            cache: false,
            ajax: {
                url: '{{route("$route")}}',
                dataType: "json",
                type: "post",
                delay: 1000,
                data: function (term) {
                    return {
                        q: term, // search term
                        "_token": "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: {!!  $text!=null?$text:"item.name"!!},
                                id: item.id
                            }
                        })
                    };
                }
            },
            templateSelection: function (item) {
                return item.name || item.text;
            }
        });
    });

</script>
