<x-main>
    <x-slot name="title">
        Gestion utilisateurs
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Utilisateurs
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
						<span class="card-icon">
                            <i class="flaticon-notepad text-primary"></i>
                        </span>
                    <h3 class="card-label">Listing des Roles</h3>
                </div>
                <div class="card-toolbar">

                    <a id="add" class=" text-white btn btn-success" data-toggle="modal"
                       data-target="#addRoleForm">
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
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        {{--        add user role--}}
        <x-modal modal-title="Ajouter un role" method="POST" route="roles.store" form-id="addRoleForm"
                 modal-name="addRoleForm">
            <x-slot name="modalContent">
                @csrf
                <div class="form-group">
                    <x-input-group labelclass="" id="roleNameToAdd" name="name" labelname="Nom" class="form-control" type="text"
                                   placeholder="Entrer un Nom" grid="" step="" min=""/>
                </div>
            </x-slot>
        </x-modal>

        {{--        modal update role--}}
        <x-modal modal-title="Modifier un role" method="POST" route="register" form-id="updateRoleForm"
                 modal-name="updateRoleModal">
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <x-input-group labelclass="" id="roleNameToUpdate" name="nameUpdate" labelname="Nom" class="form-control" type="text"
                               placeholder="Entrer un Nom" grid="" step="" min=""/>

            </x-slot>
        </x-modal>

        {{--        end modal update role--}}
    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>

        <x-js-data-table route='{{route("roles.index")}}' tableId="kt_datatable">
            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/admin/role_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            var id;
            var name;
            $('#updateRoleForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    }
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
                name = $(this).data("name");
                $("#updateRoleForm").attr("action", "{{route("roles.update",["user"=>""])}}" + "/" + id);
                $('#roleNameToUpdate').val(name);
            });
        </script>

    </x-slot>
</x-main>
