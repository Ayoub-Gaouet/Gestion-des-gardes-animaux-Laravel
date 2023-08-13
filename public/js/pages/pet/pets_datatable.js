[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'age', name: 'age'},
    {data: 'type', name: 'type'},
    {data: 'needs', name: 'needs'},
    {
        data: 'petowner_id', name: 'petowner_id', render: function (data, type, full, meta) {
            return full.petowner.name;

        }
    },
    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
