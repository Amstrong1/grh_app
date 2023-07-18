<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Nouvelle fiche de paie</h1>

                    <form action="{{ route('pay.store') }}" method="POST">
                        @csrf

                        @livewire('select-employee')

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button class="ml-4">
                                {{ __('Créer fiche de paie') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
