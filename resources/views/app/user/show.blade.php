<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Voir les informations de {{ $career->user->name }}</h1>
                    <x-forms.show :item="$career" :fields="$my_fields" type="career" />
                    <div class="flex items-center justify-start mt-4">
                        <a href="{{ route('career.index') }}">
                            <x-primary-button class="ml-4">
                                {{ __('Retour') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
