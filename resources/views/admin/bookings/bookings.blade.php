<x-main>
    <x-slot name="title">
        Gestion bookings
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Bookings
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon-notepad text-primary"></i>
                            </span>
                    <h3 class="card-label">Listing des bookings</h3>
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
                        <th>Name</th>
                        <th>Services</th>
                        <th>cost</th>
                        <th>confirmation_status</th>
                        <th>cancellation_status</th>
                        <th>User</th>
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
                        <th>Name</th>
                        <th>Services</th>
                        <th>cost</th>
                        <th>confirmation_status</th>
                        <th>cancellation_status</th>
                        <th>User</th>
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
        <x-modal modal-title="Ajouter un booking" method="POST" route="booking.store" form-id="addForm"
                 modal-name="addModal">
            <x-slot name="modalContent">
                @csrf
                <x-input-group labelclass="" id="name" name="name" labelname="name" class="form-control" type="text"
                               placeholder="Entrer un name instruction" grid="" step="" min=""/>

                <x-select2 id="services" name="services" labelname="services" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        <option>Dressage</option>
                        <option>Nourriture</option>
                        <option>Brossage</option>
                        <option>vaccins</option>
                    </x-slot>
                </x-select2>
                <x-select2 id="type_of_pets_can_care" name="type_of_pets_can_care[]" labelname="Type des pet qui specialise" class="select2"
                           required="required" multiple="multiple" grid="">
                    <x-slot name="content">
                        <option value="chien">Chien</option>
                        <option value="chat">Chat</option>
                    </x-slot>
                </x-select2>

                <x-input-group labelclass="" id="cost" name="cost" labelname="cost" class="form-control" type="number"
                               placeholder="Entrer un cost" grid="" min="" step="any"/>

                <x-select2 id="confirmation_status" name="confirmation_status" labelname="confirmation_status" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option value="0">Non</option>
                        <option value="1">Oui</option>
                        </x-slot>
                </x-select2>

                <x-select2 id="cancellation_status" name="cancellation_status" labelname="cancellation_status" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                    </x-slot>
                </x-select2>

                <x-select2 id="user" name="user" labelname="User" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>

                        @endforeach
                    </x-slot>
                </x-select2>
            </x-slot>
        </x-modal>
        {{--        update user modal--}}
        <x-modal modal-title="Modifier un booking" method="POST" route="bookings.update" form-id="updateForm"
                 modal-name="updateModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="nameUpdate" name="name" labelname="name" class="form-control" type="text"
                               placeholder="Entrer un name instruction" grid="" step="" min=""/>

                <x-select2 id="servicesUpdate" name="services" labelname="Services" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        <option>Dressage</option>
                        <option>Nourriture</option>
                        <option>Brossage</option>
                        <option>vaccins</option>
                    </x-slot>
                </x-select2>

                <x-input-group labelclass="" id="costUpdate" name="cost" labelname="cost" class="form-control" type="text"
                               placeholder="Entrer un cost" grid="" min="" step=""/>

                <x-input-group labelclass="" id="confirmation_statusUpdate" name="confirmation_status" labelname="confirmation_status"
                               class="form-control" type="text"
                               placeholder="Entrer un confirmation status" grid="" min="" step=""/>
                <x-input-group labelclass="" id="cancellation_statusUpdate" name="cancellation_status" labelname="cancellation_status"
                               class="form-control" type="text"
                               placeholder="Entrer un cancellation status" grid="" min="" step=""/>

                <x-select2 id="userUpdate" name="user" labelname="User" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>

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
            $(document).on('shown.bs.modal', '#roleModalbooking', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>
        <x-js-data-table route='{{route("bookings.index")}}' tableId="kt_datatable">

            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/booking/bookings_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var name;
            var special_instruction;
            var cost;
            var confirmation_status;
            var cancellation_status;
            var user_id;

            $('#updateForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    special_instructionUpdate: {
                        required: true,
                        minlength: 2
                    },
                    costUpdate: {
                        required: true,
                        minlength: 2
                    },
                    confirmation_statusUpdate: {
                        required: true
                    },
                    cancellation_statusUpdate: {
                        required: true
                    },
                    user_idUpdate: {
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
                $("#updateForm").attr("action", "{{route("bookings.update",["booking"=>""])}}" + "/" + id);
                $('#nameUpdate').val($(this).data("name"));
                $('#servicesUpdate').val($(this).data("services")).trigger("change");
                $('#costUpdate').val($(this).data("cost"));
                $('#confirmation_statusUpdate').val($(this).data("confirmation_status"));
                $('#cancellation_statusUpdate').val($(this).data("cancellation_status"));
                $('#userUpdate').val($(this).data("user")).trigger("change");
            });
        </script>
        <script>
            var id;

            $('body').on('click', '.delete_booking', function () {
                id = $(this).data("id");
                var message = "Are you sure you want to delete this booking?";
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
                            url: "{{route('bookings.destroy',["booking" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Success',
                                        text: data.message,
                                        icon: 'success'
                                    });
                                    location.reload();
                                }else {
                                    swal.fire({
                                        title: 'Erreur',
                                        text: data.message,
                                        icon: 'error'
                                    });
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
