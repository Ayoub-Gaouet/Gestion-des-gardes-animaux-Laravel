@props(["homeUrl"=>"/","method"=>"POST","route", "validation" => "", "cardTitle" => "", "cardDescription" => ""])
    <!DOCTYPE html>
<html lang="fr">
<!--begin Head-->
<head>
    <x-head title="Promed">
    </x-head>
</head>
<!--end Head-->
<!--begin Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable">
<!--begin Main-->
<div class="d-flex flex-column flex-root">
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-bottom bgi-no-repeat"
             style="background-image: url({{asset("images/background/". $background)}});">
            <div class="card shadow-lg login-form text-center p-7 position-relative overflow-hidden">
                <!--begin Logo-->
                <div class="card-body" style="width: 425px;">
                    <div class="d-flex flex-center mb-15">
                        <a href="{{$homeUrl}}">
                            <img alt="Logo" src="{{asset("images/logo/". $logo)}}" class="max-h-75px"/>
                        </a>
                    </div>
                    <!--end Logo-->
                    <!--begin Wrapper-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>{{ $cardTitle }}</h3>
                            <div class="text-muted font-weight-bold">{{ $cardDescription }}</div>
                        </div>
                    {{ $validation }}
                    <!--begin Form-->
                        <form class="form-group mb-5" method="{{$method}}" id="kt_sign_in_form"
                              action="{{ route($route) }}">
                            @csrf
                            {{$formContent}}
                        </form>
                        <!--end Form-->
                    </div>
                </div>
                <!--end Wrapper-->
            </div>
            <!--end Content-->

        </div>
    </div>
    <!--end Authentication - Sign-in-->
</div>
<!--end Main-->
<x-js></x-js>
</body>
<!--end Body-->
</html>
