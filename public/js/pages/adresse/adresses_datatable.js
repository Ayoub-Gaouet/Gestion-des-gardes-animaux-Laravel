[
    {data: 'id', name: 'id'},
    {data: 'rue', name: 'rue'},
    {data: 'ville', name: 'ville'},
    {data: 'code_postal', name: 'code_postal'},
    {data: 'petsitter_id', name: 'petsitter_id' ,render: function (data, type, full, meta) {
            return full.petsitter.name;
        }
    },
    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
