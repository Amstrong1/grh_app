<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Modifier les informations de {{ $task->name }}</h1>
                    <x-forms.update :item="$task" :fields="$my_fields" type="task" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>