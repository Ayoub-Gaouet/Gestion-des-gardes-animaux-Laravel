[
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'services', name: 'services'},
    {data: 'cost', name: 'cost'},
    {data: 'confirmation_status', name: 'confirmation_status'},
    {data: 'cancellation_status', name: 'cancellation_status'},
    {data: 'user_id', name: 'user_id' ,render: function (data, type, full, meta) {
            return full.user.name;
        }
    },
    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
