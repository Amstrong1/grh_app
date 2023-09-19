<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="-mt-4 mb-2 pb-1 text-md font-semibold">
        Envoyer un message
    </h2>

    <form method="POST" action="{{ route('contact') }}">
        @csrf

        <!-- Name -->
        <div class="">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contact -->
        <div class="mt-2">
            <x-input-label for="tel" :value="__('Contact')" />
            <x-text-input id="tel" class="block mt-1 w-full" type="tel" name="tel" :value="old('tel')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>

        <!-- Subject -->
        <div class="mt-2">
            <x-input-label for="object" :value="__('Objet')" />
            <x-text-input id="object" class="block mt-1 w-full" type="text" name="object" :value="old('object')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('object')" class="mt-2" />
        </div>

        {{-- Message --}}
        <div class="mt-2">
            <x-input-label for="message" :value="__('Message')" />
            <textarea id="editor"
                class="block mt-1 w-full p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg"
                :value="old('message')" name="message" id="" cols="30" rows="5"></textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="g-recaptcha mt-4" data-sitekey={{ config('services.recaptcha.key') }}></div>

        <div class="flex items-center justify-start mt-4">
            <a href="/">
                <x-danger-button type='button' class="ml-3">
                    {{ __('Annuler') }}
                </x-danger-button>
            </a>

            <x-primary-button class="ml-3">
                {{ __('Envoyer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
