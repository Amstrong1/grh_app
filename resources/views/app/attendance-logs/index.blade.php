<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-bold text-lg my-2">Liste des pointages</h1>

                        <x-forms.filter :action="route('attendance_log.filter')" />
                            
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$attendanceLogs" :mattributes="$my_attributes" type="attendance_log" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
