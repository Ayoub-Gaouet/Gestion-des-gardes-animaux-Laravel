<x-main>
    <x-slot name="title">
        Gestion adresses
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Adresses
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon-notepad text-primary"></i>
                            </span>
                    <h3 class="card-label">Listing des Adresses</h3>
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
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Pet sitter</th>
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
                        <th>Rue</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Pet sitter</th>
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
        <x-modal modal-title="Ajouter un adresse" method="POST" route="adresse.store" form-id="addForm"
                 modal-name="addModal">
            <x-slot name="modalContent">
                @csrf
                <x-input-group labelclass="" id="rue" name="rue" labelname="rue" class="form-control" type="text"
                               placeholder="Entrer un rue" grid="" step="" min=""/>

                <x-input-group labelclass="" id="ville" name="ville" labelname="ville" class="form-control" type="text"
                               placeholder="Entrer un ville" grid="" min="" step=""/>

                <x-input-group labelclass="" id="code_postal" name="code_postal" labelname="code_postal"
                               class="form-control" type="text"
                               placeholder="Entrer un code postal" grid="" min="" step=""/>
                <x-select2 id="petsitter" name="petsitter" labelname="Petsitter" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($petsitters as $petsitter)
                            <option value="{{$petsitter->id}}">{{$petsitter->name}}</option>

                        @endforeach
                    </x-slot>
                </x-select2>
            </x-slot>
        </x-modal>
        {{--        update user modal--}}
        <x-modal modal-title="Modifier un adresse" method="POST" route="adresses.update" form-id="updateForm"
                 modal-name="updateModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="rueUpdate" name="rue" labelname="Nom" class="form-control" type="text"
                               placeholder="Entrer un rue" grid="" step="" min=""/>

                <x-input-group labelclass="" id="villeUpdate" name="ville" labelname="Age" class="form-control"
                               type="text"
                               placeholder="Entrer un ville" grid="" min="" step=""/>

                <x-input-group labelclass="" id="code_postalUpdate" name="code_postal" labelname="code_postal"
                               class="form-control" type="text"
                               placeholder="Entrer un code postal" grid="" min="" step=""/>
                <x-select2 id="petsitterUpdate" name="petsitter" labelname="Petsitter" class="select2"
                           required="required" multiple="" grid="">
                    <x-slot name="content">
                        <option></option>
                        @foreach($petsitters as $petsitter)
                            <option value="{{$petsitter->id}}">{{$petsitter->name}}</option>

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
            $(document).on('shown.bs.modal', '#roleModaladresse', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>
        <x-js-data-table route='{{route("adresses.index")}}' tableId="kt_datatable">

            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/adresse/adresses_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var rue;
            var ville;
            var code_postal;
            var petsitter_id;

            $('#updateForm').validate({
                rules: {
                    rueUpdate: {
                        required: true,
                        minlength: 2
                    },
                    villeUpdate: {
                        required: true,
                        minlength: 2
                    },
                    code_postalUpdate: {
                        required: true,
                        minlength: 2
                    },
                    petsitter_idUpdate: {
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

                $("#updateForm").attr("action", "{{route("adresses.update",["adresse"=>""])}}" + "/" + id);
                $('#rueUpdate').val($(this).data("rue"));
                $('#villeUpdate').val($(this).data("ville"));
                $('#code_postalUpdate').val( $(this).data("code_postal"));
                $('#petsitterUpdate').val( $(this).data("petsitter_id")).trigger("change");

            });
        </script>
        <script>
            var id;

            $('body').on('click', '.delete_adresse', function () {
                id = $(this).data("id");
                var message = "Are you sure you want to delete this adresse?";
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
                            url: "{{route('adresses.destroy',["adresse" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Success',
                                        text: "The adresse was successfully deleted.",
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
