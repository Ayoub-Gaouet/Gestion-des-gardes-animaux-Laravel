[
    {data: 'id', name: 'id'},
    {data: 'driver_id', name: 'driver_id'},
    {data: 'driver.name', name: 'driver.name'},
    {data: 'delivery_circuits.name', name: 'delivery_circuits.name'},
    {data: 'barcode', name: 'barcode'},
    {
        data: 'status', name: 'status', render: function (data, type, full, meta) {
            if (full.status == 0) {
                return '<span class="label label-lg font-weight-bold label-light-primary label-inline" >En Attente</span>';
            } else if (full.status == 1) {
                return ' <span class="label label-lg font-weight-bold label-light-warning label-inline" >En cours</span>';
            } else if (full.status == 2) {
                return ' <span class="label label-lg font-weight-bold label-light-success label-inline" >Livré</span>';
            } else if (full.status == 3) {
                return ' <span class="label label-lg font-weight-bold label-light-danger label-inline" >Rejeté</span>';
            }
        }
    },
    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
