<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        M/Mme {{ $user->name . ' ' . $user->firstname }} <br>
        Bienvenue sur E-GRH, veuillez définir un mot de passe pour votre compte utilisateur
    </div>

    <form method="POST" action="{{ route('password.first.update', [$user->id]) }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe (Confirmation)')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
