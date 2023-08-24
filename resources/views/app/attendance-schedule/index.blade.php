<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">Emploi du temps</h1>
                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superviseur')
                            <a href="{{ route('attendance_schedule.create') }}">
                                <x-primary-button>
                                    Nouveau
                                </x-primary-button>
                            </a>
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$attendanceSchedules" :mattributes="$my_attributes" type="attendance_schedule"
                            :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
