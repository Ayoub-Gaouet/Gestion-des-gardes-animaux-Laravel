<div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper"></div>
        <div class="topbar">


        <!--begin::User-->
            <div class="topbar-item">

                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                     id="kt_quick_user_toggle">
                    <span
                        class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{ __('messages.Hello') }}</span>
                    <span
                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{$user->name}}</span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                         @php
                             $image = asset("images/users/");

                             if($guard_web){
                                 $image = "images/clients/";
                             }
                         @endphp
                        <img alt="Logo"
                             src="{{ asset($image. '/' .(( $user->photo == "" || $user->photo == null)? "blank.png" : $user->photo)) }}"/>
                    </span>
                </div>
            </div>

            <!--end::User-->

        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
