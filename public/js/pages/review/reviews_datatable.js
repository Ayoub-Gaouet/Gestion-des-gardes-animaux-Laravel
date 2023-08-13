[
    {data: 'id', name: 'id'},
    {data: 'rating', name: 'rating'},
    {data: 'comment', name: 'comment'},
    {data: 'booking_id', name: 'booking_id' ,render: function (data, type, full, meta) {
            return full.booking.name;
        }
    },

    {data: 'created_at', name: 'created_at', searchable: false},
    {data: 'updated_at', name: 'updated_at', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false},
]
