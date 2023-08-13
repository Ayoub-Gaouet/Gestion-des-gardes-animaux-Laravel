<x-main-guest-layout :route='isset($url)?($url.".password.email"):"password.email"' cardTitle="Mot de passe obliée?"

                     cardDescription="Mot de passe oublié? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un niveau.">
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="formContent">

        <!--begin::Input group-->

        <x-input-without-label id="email" name="email" class="form-control h-auto form-control-solid py-4 px-8"
                               type="email" required="required"
                               placeholder="Email" grid="fv-row mb-10" autocomplete=""/>
        <!--end::Input group-->
        <!--begin::Actions-->

        <div class="form-group d-flex flex-wrap flex-center mt-10">
            <button type="submit" id="kt_login_forgot_submit"
                    class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('messages.Submit') }}</button>
            @php
                if(Route::currentRouteName() == 'admin.password.request')
                    {
                      $route = route('admin.login');
                    }
                    else{
                       $route =  route('login');
                    }
            @endphp
            <a href="{{ $route }}" id="kt_login_forgot_cancel"
               class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</a>
        </div>
    {{--        <div class="d-flex flex-wrap justify-content-center pb-lg-0">--}}
    {{--            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">--}}
    {{--                <span class="indicator-label">{{ __('messages.Submit') }}</span>--}}
    {{--                <span class="indicator-progress">Please wait...--}}
    {{--									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>--}}
    {{--            </button>--}}
    {{--            <a href="{{ route('login') }}"--}}
    {{--               class="btn btn-lg btn-light-primary fw-bolder">{{ __('messages.Cancel') }}</a>--}}
    {{--        </div>--}}
    <!--end::Actions-->
    </x-slot>
</x-main-guest-layout>
