<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-bold text-lg my-2">Liste des pointages</h1>

                        <form action="{{ route('attendance_log.filter') }}" method="POST">
                            @csrf
                            <div class="md:flex text-sm mx-2">
                                <div class="p-2">
                                    <span>Période du</span>
                                    <input
                                        class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg"
                                        type="date" name="start" value="{{ request()->start }}">
                                    <span>
                                        au
                                    </span>
                                    <input
                                        class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg"
                                        type="date" name="end" value="{{ request()->end }}">
                                    <x-secondary-button class="py-3 border-gray-300 border-2 shadow-lg" type="submit">
                                        Appliquer
                                    </x-secondary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$attendanceLogs" :mattributes="$my_attributes" type="attendance_log" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
