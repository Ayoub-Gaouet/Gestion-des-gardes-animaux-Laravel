<x-main>
    <x-slot name="title">
        Profile
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{asset("plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/slim-image-cropper/slim.min.css")}}">
        <link rel="stylesheet" href="{{asset("plugins/slim-image-cropper/style.css")}}">
    </x-slot>

    <x-slot name="subHeaderTitle">
        Profile
    </x-slot>
    <x-slot name="bodyContent">
        <div class="card card-custom">
            <!--begin::Card header-->
            <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <!--begin::Item-->
                        <li class="nav-item mr-3">
                            <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1">
														<span class="nav-icon">
															<span class="svg-icon">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"/>
																		<path
                                                                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
																		<path
                                                                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                                            fill="#000000" opacity="0.3"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                                <span class="nav-text font-size-lg">Profil</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_3">
														<span class="nav-icon">
															<span class="svg-icon">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
																<svg xmlns="http://www.w3.org/2000/svg"
                                                                     width="24px" height="24px" viewBox="0 0 24 24"
                                                                     version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                                            fill="#000000" opacity="0.3"/>
																		<path
                                                                            d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                                                                            fill="#000000" opacity="0.3"/>
																		<path
                                                                            d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                                            fill="#000000" opacity="0.3"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                                <span class="nav-text font-size-lg">Modifier mot de passe</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body">
                <div class="tab-content">
                    <!--begin::Tab-->
                    <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-7 my-2">
                                <!--begin::Row-->
                                <div class="row">
                                    <label class="col-3"></label>
                                    <div class="col-9">
                                        <h6 class="text-dark font-weight-bold mb-10">Informations de
                                            l'utilisateur:</h6>
                                    </div>
                                </div>
                                <!--end::Row-->


                                @php
                                    $image = asset("images/users/".$user->photo);
                                    $route = route('users.updateProfile');
                                    $password = "users.changePasswordAccount";
                                    if($guard_web){
                                        $image = asset("images/client/".$user->photo);
                                        $route = route('update.clientProfile');
                                        $password = "client.changePasswordAccount";
                                    }
                                @endphp
                                <form class="cmxform" id="updateForm" method="post"
                                      action="{{$route}}" enctype='multipart/form-data'>
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Photo de
                                            profil</label>
                                        <div class="col-9">
                                            <div class="form-group row avatar ">

                                                <label class="col-form-label col-3 text-lg-right text-left"></label>
                                                <div class="col-9">
                                                    <x-image-slim data-label="Placer votre logo ici" data-size="240,240"
                                                                  data-ratio="1:1" :image="$image" name="photo"
                                                                  remove-date="removeUserImage"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <x-input-edit-user labelclass="col-form-label col-3 text-lg-right text-left"
                                                       labelname="Nom" grid="col-9"
                                                       placeholder=""
                                                       class="form-control form-control-lg form-control-solid"
                                                       value="{{$user->name}}"
                                                       id="name"
                                                       name="name"
                                                       type="text"/>

                                    <x-input-edit-user labelclass="col-form-label col-3 text-lg-right text-left"
                                                       labelname="Adresse mail" grid="col-9"
                                                       placeholder=""
                                                       class="form-control form-control-lg form-control-solid"
                                                       value="{{$user->email}}"
                                                       id="email"
                                                       name="email"
                                                       type="email"/>


                                    <div class="card-footer pb-0">
                                        <div class="row">
                                            <div class="col-xl-2"></div>
                                            <div class="col-xl-7">
                                                <div class="row">
                                                    <div class="col-3"></div>
                                                    <div class="col-9">
                                                        <button type="submit"
                                                                class="btn btn-light-primary font-weight-bold">
                                                            Enregistrer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <label class="col-3"></label>
                                        <div class="col-9">
                                            <h6 class="text-dark font-weight-bold mb-10">Changer ou récupérer
                                                mot de passe:</h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <form class="cmxform" id="updatePasswordForm" method="post"
                                          action="{{ route($password) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-input-edit-user labelclass="col-form-label col-3 text-lg-right text-left"
                                                           labelname="Mot de passe actuel"
                                                           grid="col-9"
                                                           placeholder="Mot de passe actuel"
                                                           class="form-control form-control-lg form-control-solid mb-1"
                                                           value=""
                                                           id="current_password"
                                                           name="current_password"
                                                           type="password"/>

                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <x-input-edit-user labelclass="col-form-label col-3 text-lg-right text-left"
                                                           labelname="Nouveau mot de passe"
                                                           grid="col-9"
                                                           placeholder="Nouveau mot de passe"
                                                           class="form-control form-control-lg form-control-solid"
                                                           value=""
                                                           id="new_password"
                                                           name="new_password"
                                                           type="password"/>

                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <x-input-edit-user labelclass="col-form-label col-3 text-lg-right text-left"
                                                           labelname="Confirmer mot de passe" grid="col-9"
                                                           placeholder="Confirmer mot de passe"
                                                           class="form-control form-control-lg form-control-solid"
                                                           value=""
                                                           id="new_password_confirmation"
                                                           name="new_password_confirmation"
                                                           type="password"/>

                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <button type="submit" class="btn btn-light-primary font-weight-bold">
                                                    Enregister
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Group-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->

                        <!--end::Footer-->
                    </div>
                </div>
            </div>
            <!--begin::Card body-->
        </div>

    </x-slot>

    <x-slot name="jsSlot">
        <!--begin::Group-->
        <script src="{{asset("plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>
        <script src="{{asset("plugins/slim-image-cropper/slim.kickstart.min.js")}}"></script>
        <script>
            var avatar1 = new KTImageInput('kt_image_1');

            $('#updateForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
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
        </script>
        <script>
            function removeUserImage(data, remove) {
                if (window.confirm("Are you sure?")) {
                    remove();
                }
            }
        </script>
    </x-slot>
</x-main>
