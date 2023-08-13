<x-main-guest-layout :route='isset($url)?($url.".login"):"login"' cardTitle="Connectez-vous"
                     cardDescription="Entrez vos informations">
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="formContent">

        <x-input-without-label id="email" name="email" class="form-control h-auto form-control-solid py-4 px-8"
                               type="email" required="required"
                               placeholder="Email" grid="form-group mb-5" autocomplete=""/>

        <x-input-without-label id="password" name="password" class="form-control h-auto form-control-solid py-4 px-8"
                               type="password" required="required"
                               placeholder="Password" grid="form-group mb-5" autocomplete="current-password"/>

        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
            <div class="checkbox-inline">
                <label class="checkbox m-0 text-muted">
                    <input type="checkbox" name="remember"/>
                    <span></span>{{ __('messages.Remember_me') }}</label>
            </div>
            @php
                if(Route::currentRouteName() == 'admin.login')
                    {
                      $route = route('admin.password.request');
                    }
                    else{
                       $route =  route('password.request');
                    }
            @endphp
            <a href="{{ $route }}" id="kt_login_forgot"
               class="text-muted text-hover-primary">{{ __('messages.Forgot_your_password?') }}</a>
        </div>

        <button type="submit" id="kt_login_signin_submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('messages.Log_in') }}</button>

        <!--end Actions-->
    </x-slot>
</x-main-guest-layout>
