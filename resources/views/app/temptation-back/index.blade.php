<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-bold text-lg my-2">
                            Liste des réponses de demandes
                            @if (request()->routeIs('temptation_back.index'))
                                recus
                            @elseif (request()->routeIs('temptation_back.sent'))
                                envoyés
                            @endif
                        </h1>
                    </div>

                    <x-forms.filter :action="route('temptation_back.filter')" />

                    <div class="mt-4">
                        <x-tables.default :resources="$temptationBacks" :mattributes="$my_attributes" type="temptation_back" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
