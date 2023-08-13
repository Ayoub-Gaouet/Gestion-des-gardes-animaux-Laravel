[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'adress', name: 'adress'},
    {data: 'phone1', name: 'phone1'},
    {data: 'phone2', name: 'phone2'},
    {
        data: 'status', name: 'status', render: function (data, type, full, meta) {
            if (full.status == 0) {
                return '<span class="label label-lg font-weight-bold label-light-danger label-inline" >Désactivé</span>';
            } else if (full.status == 1) {
                return ' <span class="label label-lg font-weight-bold label-light-success label-inline" >Actif</span>';
            }
        }
    },
    {data: 'type', name: 'type', orderable: false, searchable: false},
    {data: 'Nombre_agents_clients', name: 'Nombre_agents_clients', searchable: false},

    {data: 'action', name: 'action', orderable: false, searchable: false},
]
