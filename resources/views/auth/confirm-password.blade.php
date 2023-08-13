<x-main-guest-layout :route='isset($url)?($url."password.confirm"):"password.confirm"'>
    <x-slot name="validation">
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="formContent">

        <x-input-without-label id="password" name="password" class="form-control h-auto form-control-solid py-4 px-8"
                               type="password" required="required"
                               placeholder="Password" grid="form-group mb-5" autocomplete="current-password"/>

        <div class="text-center">
            <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                {{ __('messages.Submit') }}
            </button>
        </div>

    </x-slot>
</x-main-guest-layout>
