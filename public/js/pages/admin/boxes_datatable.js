[
    {data: 'id', name: 'id'},
    {data: 'delivery_form_id', name: 'delivery_form_id'},
    {data: 'boxes_type_id', name: 'boxes_type_id'},
    {data: 'barcode', name: 'barcode'},
    {
        data: 'status', name: 'status', render: function (data, type, full, meta) {
            if (full.status == 0) {
                return '<span class="label label-lg font-weight-bolder label-inline label-primary">En Attente</span>';
            } else if (full.status == 1) {
                return ' <span class="label label-lg font-weight-bolder label-inline label-warning">En cours</span>';
            } else if (full.status == 2) {
                return ' <span class="label label-lg font-weight-bolder label-inline label-success">Livré</span>';
            } else if (full.status == 3) {
                return ' <span class="label label-lg font-weight-bolder label-inline label-danger">Rejeté</span>';
            }
        }
    }, {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
