<x-main-guest-layout :route='isset($url)?($url.".password.update"):"password.update"' >
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="formContent">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">{{ __('messages.Setup_New_Password') }}</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">{{ __('messages.Already_have_reset_your_password') }}
                <a href="{{ route('login') }}" class="link-primary fw-bolder">{{ __('messages.Sign_in_here') }}</a>
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="mb-1">
            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                     :value="old('email', $request->email)"  placeholder="Email" class="form-control h-auto form-control-solid py-4 px-8" required autofocus/>
        </div>
        <div class="mb-1" data-kt-password-meter="true">
            <!--begin::Wrapper-->

                <div class="position-relative mb-3">
                    <x-input id="password" type="password" name="password" placeholder="Mot de passe" class="form-control h-auto form-control-solid py-4 px-8" required/>

                </div>


        </div>
        <!--end::Input group=-->
        <!--begin::Input group=-->
        <div class="fv-row mb-10">

            <x-input id="password_confirmation"
                     type="password"
                     name="password_confirmation"
                     placeholder="Confirmer Mot de passe" class="form-control h-auto form-control-solid py-4 px-8" required/>
        </div>
        <!--end::Input group=-->
        <!--begin::Action-->
        <div class="text-center">
            <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                {{ __('messages.Submit') }}

            </button>
        </div>
        <!--end::Action-->
    </x-slot>
</x-main-guest-layout>
