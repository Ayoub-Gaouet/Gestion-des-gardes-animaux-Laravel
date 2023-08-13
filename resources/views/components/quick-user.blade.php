<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">Profile de {{ $user->name }}
            <small class="text-muted font-size-sm ml-2"></small></h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                @php
                    $image = asset("images/users/");
                    if($guard_web){
                        $image = "images/client/";
                    }
                @endphp
                <img alt="Logo"
                     src="{{ asset($image. '/' .(( $user->photo == "" || $user->photo == null)? "blank.png" : $user->photo)) }}"/>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<img src="{{asset("images/icones/mail.svg")}}">
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary">{{ $user->email }}</span>
								</span>
                    </a>

                    <a href="#" id="logout"
                       class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                       onclick="document.getElementById('logout-form').submit();">Se déconnecter</a>
                    @php
                        $route = route('logout');

                        if($guard_admin){
                            $route = route('admin.logout');
                        }
                    @endphp
                    <form id="logout-form" action="{{ $route }}" method="POST" class="d-none">@csrf</form>

                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
{{--        <div class="navi navi-spacer-x-0 p-0">--}}
{{--            <!--begin::Item-->--}}
{{--            @php--}}
{{--                $route = route('showClientUser.index');--}}
{{--                if($guard_admin){--}}
{{--                 $route = route('user.index');--}}
{{--                }--}}
{{--            @endphp--}}
{{--            <a href="{{ $route }}" class="navi-item">--}}
{{--                <div class="navi-link">--}}
{{--                    <div class="symbol symbol-40 bg-light mr-3">--}}
{{--                        <div class="symbol-label">--}}
{{--									<span class="svg-icon svg-icon-md svg-icon-success">--}}
{{--                                        <img src="{{asset("images/icones/profile.svg")}}">--}}
{{--									</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="navi-text">--}}
{{--                        <div class="font-weight-bold">Mon Profil</div>--}}
{{--                        <div class="text-muted">Modifier compte--}}
{{--                            <span class="label label-light-danger label-inline font-weight-bold">Modifier</span></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

    </div>
    <!--end::Content-->
</div>
