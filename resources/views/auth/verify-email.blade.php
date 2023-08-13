<x-main-guest-layout :route='isset($url)?($url.".verification.send"):"verification.send"' cardTitle="Connectez-vous">
    
    <x-slot name="cardDescription">
        Merci pour votre inscription! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le
        lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous nous ferons un plaisir
        de vous en envoyer un autre.
    </x-slot>
    <x-slot name="validation">
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

    </x-slot>
    <x-slot name="formContent">
        <div>
            <div>
                <x-button>
                    Renvoyer l'e-mail de vérification
                </x-button>
            </div>
        </div>
    </x-slot>

</x-main-guest-layout>
