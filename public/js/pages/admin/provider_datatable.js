[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'adress', name: 'adress'},
    {
        data: 'phone1', name: 'phone1', render: function (data, type, full, meta) {
            return data.replaceAll(" ", "");
        }
    },
    {
        data: 'phone2', name: 'phone2', render: function (data, type, full, meta) {
            return data.replaceAll(" ", "");
        }
    },
    {data: 'fax', name: 'fax'},
    {data: 'zip_code', name: 'zip_code'},

    {
        data: 'status', name: 'status', render: function (data, type, full, meta) {
            if (full.status == 0) {
                return '<span class="label label-lg font-weight-bold label-light-danger label-inline">Désactivé</span>';
            } else if (full.status == 1) {
                return ' <span class="label label-lg font-weight-bold label-light-success label-inline">Actif</span>';
            }
        }
    },
    {data: 'email', name: 'email'},
    {data: 'Nombre_agents_fournisseurs', name: 'Nombre_agents_fournisseurs', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
