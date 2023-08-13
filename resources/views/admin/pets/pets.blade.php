<x-main>
    <x-slot name="title">
        Gestion pets
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Pets
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon-notepad text-primary"></i>
                            </span>
                    <h3 class="card-label">Listing des Pets</h3>
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
                        <th>Nom</th>
                        <th>Age</th>
                        <th>Type</th>
                        <th>Besoins</th>
                        <th>Propriétaire d'animal</th>
                        <th>Crée le</th>
                        <th>Mise à jour le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Age</th>
                        <th>Type</th>
                        <th>Besoins</th>
                        <th>Propriétaire d'animal</th>
                        <th>Crée le</th>
                        <th>Mise à jour le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        {{--        add user modal--}}
        <x-modal modal-title="Ajouter un pet" method="POST" route="pet.store" form-id="addForm"
                 modal-name="addModal">
            <x-slot name="modalContent">
                @csrf
                <x-input-group labelclass="" id="name" name="name" labelname="Nom" class="form-control" type="text"
                               placeholder="Entrer un Nom" grid="" step="" min=""/>

                <x-input-group labelclass="" id="age" name="age" labelname="Age" class="form-control" type="number"
                               placeholder="Entrer un Age" grid="" min="" step=""/>

                <x-select2 id="type" name="type" labelname="Type" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option>Chien</option>
                        <option>Chat</option>
                    </x-slot>
                </x-select2>

                <x-input-group labelclass="" id="needs" name="needs" labelname="Besoins"
                               class="form-control" type="text"
                               placeholder="Entrer un Besoin" grid="" min="" step=""/>

                <x-select2 id="petowner" name="petowner" labelname="Petowner" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($petowners as $petowner)
                            <option value="{{$petowner->id}}">{{$petowner->name}}</option>

                        @endforeach
                    </x-slot>
                </x-select2>
            </x-slot>
        </x-modal>
        {{--        update user modal--}}
        <x-modal modal-title="Modifier un pet" method="POST" route="pets.update" form-id="updateForm"
                 modal-name="updateModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="nameUpdate" name="name" labelname="Nom" class="form-control"
                               type="text"
                               placeholder="Entrer un Nom" grid="" step="" min=""/>

                <x-input-group labelclass="" id="ageUpdate" name="age" labelname="Age" class="form-control"
                               type="number"
                               placeholder="Entrer un Age" grid="" min="" step=""/>

                <x-select2 id="typeUpdate" name="type" labelname="Type" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option>Chien</option>
                        <option>Chat</option>
                    </x-slot>
                </x-select2>

                <x-input-group labelclass="" id="needsUpdate" name="needs" labelname="Besoins"
                               class="form-control" type="text"
                               placeholder="Entrer un Besoin" grid="" min="" step=""/>

                <x-select2 id="petownerUpdate" name="petowner" labelname="Petowner" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($petowners as $petowner)
                            <option value="{{$petowner->id}}">{{$petowner->name}}</option>

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
            $(document).on('shown.bs.modal', '#roleModalPet', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>
        <x-js-data-table route='{{route("pets.index")}}' tableId="kt_datatable">

            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/pet/pets_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var name;
            var age;
            var type;
            var needs;
            var petowner_id;
            $('#updateForm').validate({
                rules: {
                    nameUpdate: {
                        required: true,
                        minlength: 2
                    },
                    ageUpdate: {
                        required: true,
                        minlength: 2
                    },
                    typeUpdate: {
                        required: true,
                        minlength: 2
                    },
                    needsUpdate: {
                        required: true,
                        minlength: 2
                    },
                    client_idUpdate: {
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
                $("#updateForm").attr("action", "{{route("pets.update",["pet"=>""])}}" + "/" + id);
                name = $(this).data("name");
                age = $(this).data("age");
                type = $(this).data("type");
                $('#idUpdate').val(id);
                $('#nameUpdate').val(name);
                $('#ageUpdate').val(age);
                $('#typeUpdate').val(type).trigger("change");
                $('#needsUpdate ').val($(this).data("needs"));
                $('#petownerUpdate').val($(this).data("petowner")).trigger("change");
            });
        </script>
        <script>
            var id;

            $('body').on('click', '.delete_pet', function () {
                id = $(this).data("id");
                var message = "Are you sure you want to delete this pet?";
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
                            url: "{{route('pets.destroy',["pet" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Success',
                                        text: "The pet was successfully deleted.",
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
