<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">Liste des employés</h1>
                        <x-primary-button>
                            <a href="{{ route('career.create') }}">Nouveau</a>
                        </x-primary-button>
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$careers" :mattributes="$my_attributes" type="career" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>