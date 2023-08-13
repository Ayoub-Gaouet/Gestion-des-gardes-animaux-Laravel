[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'age', name: 'age'},
    {data: 'genre', name: 'genre'},
    {data: 'tel', name: 'tel'},
    {data: 'number_of_year_of_exp', name: 'number_of_year_of_exp'},
    {data: 'type_of_pets_can_care', name: 'type_of_pets_can_care'},
    {data: 'email', name: 'email'},
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
