<x-guest-layout>

    <h2 class="mb-2 mt-1 pb-1 text-md font-semibold">
        Créer un compte administrateur
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="firstname" :value="__('Prénom')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                required autofocus autocomplete="" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email_struct" :value="__('Email de l\'entreprise')" />
            <x-text-input id="emai_structl" class="block mt-1 w-full" type="email" name="email_struct"
                :value="old('email_struct')" required autocomplete="" />
            <x-input-error :messages="$errors->get('email_struct')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email de l\'administrateur')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer Mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">
                    J'ai lu, compris et accepté les conditions d'utilisation et la <a class="text-indigo-500"
                        href="{{ route('coming-soon') }}">politique de
                        confidentialité</a> de RH-IA et j'accepte de recevoir des emails de RH-IA
                </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Se connecter') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
    {{-- <img src="{{ asset('assets/img/404.svg') }}" alt="Not found">
    <h1>Vous tentez d'accéder à une ressource qui n'est pas disponible, contacter votre administrateur pour plus d'information</h1> --}}
</x-guest-layout>
