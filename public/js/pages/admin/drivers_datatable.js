[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'login', name: 'login'},
    {data: 'phone', name: 'phone'},
    {
        data: 'status', name: 'status', render: function (data, type, full, meta) {
            if (full.status == 0) {
                return '<span class="label label-lg font-weight-bold label-light-danger label-inline">Désactivé</span>';
            } else if (full.status == 1) {
                return ' <span class="label label-lg font-weight-bold label-light-success label-inline">Actif</span>';
            }
        }
    },
    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
