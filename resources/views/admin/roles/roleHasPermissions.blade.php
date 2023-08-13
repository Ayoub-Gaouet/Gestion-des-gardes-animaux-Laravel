<x-main>
    <x-slot name="title">
        Roles
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Roles
    </x-slot>
    <x-slot name="bodyContent">

        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
						<span class="card-icon">
                            <i class="flaticon-notepad text-primary"></i>
                        </span>
                    <h3 class="card-label">Listing des Permissions</h3>

                </div>
                <div class="card-toolbar">
                    @if($user->hasPermissionTo(100004))
                        <a id="add" class=" text-white btn btn-success" data-toggle="modal"
                           data-target="#addModal">
                            <i class="fas fa-plus"></i>Affecter une permission</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table align-middle" id="kt_datatable">
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Role</th>
                        <th>module</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr class="fw-bolder text-muted bg-light">
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Role</th>
                        <th>module</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <!--end: Datatable-->
            </div>
        </div>

        <x-modal modal-title="Affecter une permission" method="POST" route="permissions.givePermissionToRole"
                 form-id="affectForm"
                 modal-name="addModal">
            <x-slot name="routeParam">
                {{ $role->id }}
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                <div class="row">

                    <x-select2 id="modules" name="modules" labelname="Module" class="form-group select2"
                               required="required" multiple="" grid="col-sm-6">
                        <x-slot name="content">
                            <option></option>
                            @foreach($modules as $module)
                                <option value="{{$module->id}}">{{$module->name}}</option>
                            @endforeach
                        </x-slot>
                    </x-select2>

                    <x-select2 id="permissions" name="permissions[]" labelname="Permission" class="form-group select2"
                                required="required" multiple="multiple" grid="col-sm-6">
                        <x-slot name="content">
                            <option></option>
                        </x-slot>
                    </x-select2>

                </div>
            </x-slot>
        </x-modal>
    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>
        <script src="{{asset("plugins/select2/js/select2.full.min.js")}}"></script>

        <script>
            var select = $('.select2').select2();
            $(document).on('shown.bs.modal', '#addModal', function (evt) {
                select.trigger("change");
                $('.select2-ajax').trigger("change");
            });
        </script>

        <x-js-data-table :route="route('permissions.index', ['role' => $role->id])" tableId="kt_datatable">
            <x-slot name="jsonColumns">
                {!! file_get_contents(public_path("js/pages/admin/role_has_permission_datatable.js")) !!}
            </x-slot>
        </x-js-data-table>
        <script>
            $(document).ready(function () {
                $(function () {
                    $('#affectForm').validate({
                        rules: {
                            permissions: {
                                required: true,
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
                });

                $('#modules').on("change", function () {

                    var id = $('#modules').find('option:selected').val();

                    $("#permissions").empty();
                    $.ajax({
                        url: "{{route('permissions.displayPermissions', ['role' => $role->id])}}" + "/" + id,
                        type: 'get',
                        dataType: 'json',
                        success: function (response) {

                            var len = 0;
                            if (response != null) {
                                len = response.length;
                            }

                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = response[i].id;
                                    var name = response[i].name;
                                    var option = "<option value='" + id + "'>" + name + "</option>;";
                                    $("#permissions").append(option);
                                }
                            }
                        }
                    });
                });

            });
        </script>

        <script>
            @if($user->hasPermissionTo(100005))
            $('body').on('click', '.destroy', function () {
                console.log("destroy");
                var id = $(this).data("id");

                swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: "Cliquez sur Oui pour supprimer la permission n°" + id,
                    icon: 'warning',
                    buttons: {
                        cancel: true,
                        delete: 'Oui, supprimer!'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            method: 'post',
                            dataType: 'json',
                            data: {"_method": 'delete', "_token": "{{csrf_token()}}"},
                            url: "{{route('permissions.destroy',["role"=>$role->id, "permission" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Succès',
                                        text: "Opération effectuée avec succès",
                                        icon: 'success'
                                    });
                                    location.reload();
                                } else {
                                    swal.fire({
                                        title: 'Erreur',
                                        text: data.message != null ? data.message : "Une Erreur est servenue ,veuillez réesayer plus tard",
                                        icon: 'error'
                                    })
                                }


                            },
                            error: function (data) {
                                console.log(data.responseText);
                                console.log("error");
                                // window.location.reload();

                            }
                        });
                    }
                });

            });
            @endif
        </script>
    </x-slot>
</x-main>
