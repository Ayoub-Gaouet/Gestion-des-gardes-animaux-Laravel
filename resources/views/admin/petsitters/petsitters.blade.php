<x-main>
    <x-slot name="title">
        Gestion Pet Sitter
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Pet Sitters
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon-notepad text-primary"></i>
                            </span>
                    <h3 class="card-label">Listing des Pet Sitters</h3>
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
                        <th>age</th>
                        <th>genre</th>
                        <th>tel</th>
                        <th>number of year of exp</th>
                        <th>type of pets can care</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>age</th>
                        <th>genre</th>
                        <th>tel</th>
                        <th>number of year of exp</th>
                        <th>type of pets can care</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        {{--        add petsitter modal--}}
        <x-modal modal-title="Ajouter un pet owner" method="POST" route="petsitter.store" form-id="addForm"
                 modal-name="addModal">
            <x-slot name="modalContent">
                @csrf
                <x-input-group labelclass="" id="name" name="name" labelname="Nom" class="form-control" type="text"
                               placeholder="Entrer un Nom" grid="" step="" min=""/>
                <x-input-group labelclass="" id="age" name="age" labelname="age" class="form-control" type="number"
                               placeholder="Entrer un age" grid="" min="" step="any"/>
                <x-select2 id="genre" name="genre" labelname="Genre" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option>Male</option>
                        <option>Female</option>
                    </x-slot>
                </x-select2>
                <x-input-group labelclass="" id="tel" name="tel" labelname="Tel" class="form-control" type="text"
                               placeholder="Entrer un Tel" grid="" step="" min=""/>

                <x-input-group labelclass="" id="number_of_year_of_exp" name="number_of_year_of_exp" labelname="Nombre des annees d'experience" class="form-control" type="number"
                               placeholder="Entrer un Nombre des annees d'experience" grid="" step="" min=""/>

                <x-select2 id="type_of_pets_can_care" name="type_of_pets_can_care" labelname="Type des pet qui specialise" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option value="chien">Chien</option>
                        <option value="chat">Chat</option>
                    </x-slot>
                </x-select2>

                <x-input-group labelclass="" id="email" name="email" labelname="Email" class="form-control" type="email"
                               placeholder="Entrer un Email" grid="" min="" step=""/>

                <x-input-group labelclass="" id="password" name="password" labelname="Mot de passe" class="form-control"
                               type="password"
                               placeholder="Entrer un mot de passe" grid="" min="" step=""/>
            </x-slot>
        </x-modal>
        {{--        update petsitter modal--}}
        <x-modal modal-title="Modifier un pet owner" method="POST" route="petsitters.update" form-id="updateForm"
                 modal-name="updateModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="nameUpdate" name="name" labelname="Nom" class="form-control" type="text"
                               placeholder="Entrer un Nom" grid="" min="" step=""/>
                <x-input-group labelclass="" id="ageUpdate" name="age" labelname="age" class="form-control" type="number"
                               placeholder="Entrer un age" grid="" min="" step="any"/>
                <x-select2 id="genreUpdate" name="genre" labelname="Genre" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option>Male</option>
                        <option>Female</option>
                    </x-slot>
                </x-select2>
                <x-input-group labelclass="" id="telUpdate" name="tel" labelname="Tel" class="form-control" type="text"
                               placeholder="Entrer un Tel" grid="" step="" min=""/>
                <x-input-group labelclass="" id="number_of_year_of_expUpdate" name="number_of_year_of_exp" labelname="Nombre des annees d'experience" class="form-control" type="number"
                               placeholder="Entrer un Nombre des annees d'experience" grid="" step="" min=""/>
                <x-select2 id="type_of_pets_can_careUpdate" name="type_of_pets_can_care" labelname="Type des pet qui specialise" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option value="chien">Chien</option>
                        <option value="chat">Chat</option>
                    </x-slot>
                </x-select2>
                <x-input-group labelclass="" id="emailUpdate" name="email" labelname="Email" class="form-control" type="email"
                               placeholder="Entrer un Email" grid="" min="" step=""/>
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
            $(document).on('shown.bs.modal', '#roleModalUPetSitter', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>
        <x-js-data-table route='{{route("petsitters.index")}}' tableId="kt_datatable">

            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/petsitter/petsitters_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var name;
            var email;
            $('#updateForm').validate({
                rules: {
                    nameUpdate: {
                        required: true,
                        minlength: 2
                    },
                    emailUpdate: {
                        required: true,
                        email: true
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
                $("#updateForm").attr("action", "{{route("petsitters.update",["petsitter"=>""])}}" + "/" + id);
                $('#nameUpdate').val($(this).data("name"));
                $('#ageUpdate').val($(this).data("age"));
                $('#genreUpdate').val($(this).data("genre")).trigger("change");
                $('#telUpdate').val($(this).data("tel"));
                $('#number_of_year_of_expUpdate').val($(this).data("number_of_year_of_exp"));
                $('#type_of_pets_can_careUpdate').val($(this).data("type_of_pets_can_care")).trigger("change");
                $('#emailUpdate').val($(this).data("email"));
            });
        </script>
        <script>
            $('body').on('click', '.desactiver', function () {
                console.log('status');
                var id = $(this).data("id");
                var message = $(this).data("name");
                swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: message + id,
                    icon: 'warning',
                    buttons: {
                        cancel: true,
                        delete: 'Oui !'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            method: 'get',
                            dataType: 'json',
                            data: {"_method": 'delete', "_token": "{{csrf_token()}}"},
                            url: "{{route('petsitters.desactivateAccount',["petsitter" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Succès',
                                        text: "Opération effectuée avec succès",
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
            })
        </script>
    </x-slot>
</x-main>
