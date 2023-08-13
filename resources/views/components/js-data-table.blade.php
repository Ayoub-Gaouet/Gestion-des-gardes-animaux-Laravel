<script>
    var table_{{$tableId}};

    $(document).ready(function () {


        table_{{$tableId}} = $('#{{$tableId}}').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            processing: true,
            serverSide: true,
            scrollX: true,
            order: [[0, 'desc']],
            ajax: @isset($data) { url: "{{$route}}", data: {!! $data !!} } @else "{{ $route }}" @endisset,
            columns: {!! $jsonColumns !!}
        });
    });
</script>
