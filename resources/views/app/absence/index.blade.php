<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">
                            Liste des permisions
                            @if (request()->routeIs('absence.allowed'))
                                accordées
                            @elseif (request()->routeIs('absence.denied'))
                                refusées
                            @elseif (request()->routeIs('absence.index'))
                                en attentes
                            @endif
                        </h1>

                        <div class="flex">
                            <form action="" method="post">
                                @csrf
                                <p class="text-sm mx-2">
                                    <span>Filtrer du </span>
                                    <input class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg" type="date" name="start" value="{{ request()->start }}">
                                    <span> au </span>
                                    <input class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg" type="date" name="end" value="{{ request()->end }}">
                                    <x-secondary-button class="py-3 border-gray-300 border-2 shadow-lg" type="submit">
                                        Appliquer
                                    </x-secondary-button>
                                </p>
                            </form>
                            <x-primary-button>
                                <a href="{{ route('absence.create') }}">Nouveau</a>
                            </x-primary-button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$absences" :mattributes="$my_attributes" type="absence" :mactions="$my_actions"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
