<x-main>
    <x-slot name="title">
        Gestion reviews
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        reviews
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon-notepad text-primary"></i>
                            </span>
                    <h3 class="card-label">Listing des reviews</h3>
                </div>
                <div class="card-toolbar">

                    <a id="add" class=" text-white btn btn-success" data-toggle="modal"
                       data-target="#addModal">
                        <i class="fas fa-plus"></i> Ajouter</a>

                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table align-middle" id="kt_datatable">
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>N°</th>
                        <th>rating</th>
                        <th>comment</th>
                        <th>Booking</th>
                        <th>Crée le</th>
                        <th>Mise à jour le</th>
                        <th>actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>N°</th>
                        <th>rating</th>
                        <th>comment</th>
                        <th>Booking</th>
                        <th>Crée le</th>
                        <th>Mise à jour le</th>
                        <th>actions</th>
                    </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        {{--        add user modal--}}
        <x-modal modal-title="Ajouter un review" method="POST" route="review.store" form-id="addForm"
                 modal-name="addModal">
            <x-slot name="modalContent">
                @csrf
                <x-input-group labelclass="" id="rating" name="rating" labelname="rating" class="form-control" type="number"
                               placeholder="Entrer un rating" grid="" min="" step="any"/>
                <x-input-group labelclass="" id="comment" name="comment" labelname="comment" class="form-control" type="text"
                               placeholder="Entrer un comment" grid="" step="" min=""/>



                <x-select2 id="booking" name="booking" labelname="Booking" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($bookings as $booking)
                            <option value="{{$booking->id}}">{{$booking->name}}</option>
                        @endforeach
                    </x-slot>
                </x-select2>
            </x-slot>
        </x-modal>
        {{--        update user modal--}}
        <x-modal modal-title="Modifier un review" method="POST" route="reviews.update" form-id="updateForm"
                 modal-name="updateModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="ratingUpdate" name="rating" labelname="rating" class="form-control" type="number"
                               placeholder="Entrer un rating" grid="" min="" step="any"/>
                <x-input-group labelclass="" id="commentUpdate" name="comment" labelname="comment" class="form-control" type="text"
                               placeholder="Entrer un comment" grid="" step="" min=""/>

                <x-select2 id="bookingUpdate" name="booking" labelname="Booking" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($bookings as $booking)
                            <option value="{{$booking->id}}">{{$booking->name}}</option>
                        @endforeach
                    </x-slot>
                </x-select2>

            </x-slot>
        </x-modal>

    </x-slot>

    <x-slot name="jsSlot">

        <script src="{{asset("plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>
        <script src="{{asset("plugins/select2/js/i18n/fr.js")}}"></script>
        <script src="{{asset("plugins/select2/js/select2.full.min.js")}}"></script>
        <script src="{{asset("js/pages/crud/forms/widgets/bootstrap-datetimepicker.js")}}"></script>
        <script>
            var select = $('.select2').select2();
            $(document).on('shown.bs.modal', '#roleModalreview', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>
        <x-js-data-table route='{{route("reviews.index")}}' tableId="kt_datatable">

            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/review/reviews_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var rating;
            var comment;
            var booking_id;

            $('#updateForm').validate({
                rules: {
                    ratingUpdate: {
                        required: true,
                        minlength: 2
                    },
                    commentUpdate: {
                        required: true,
                        minlength: 2
                    },
                    booking_idUpdate: {
                        required: true,
                        minlength: 2
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('body').on('click', '.edit', function () {
                id = $(this).data("id");
                $("#updateForm").attr("action", "{{route("reviews.update",["review"=>""])}}" + "/" + id);
                $('#ratingUpdate').val($(this).data("rating"));
                $('#commentUpdate').val($(this).data("comment"));
                $('#bookingUpdate').val( $(this).data("booking_id")).trigger("change");
            });
        </script>
        <script>
            var id;

            $('body').on('click', '.delete_review', function () {
                id = $(this).data("id");
                var message = "Are you sure you want to delete this review?";
                swal.fire({
                    title: "Confirm Delete",
                    text: message,
                    icon: 'warning',
                    buttons: {
                        cancel: true,
                        delete: 'Yes'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            method: 'delete',
                            dataType: 'json',
                            data: {"_method": 'delete', "_token": "{{csrf_token()}}"},
                            url: "{{route('reviews.destroy',["review" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Success',
                                        text: "The review was successfully deleted.",
                                        icon: 'success'
                                    });
                                    location.reload();
                                }
                            },
                            error: function (data) {
                                console.log(data.responseText);
                                console.log("error");
                                location.reload();
                            }
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-main>
