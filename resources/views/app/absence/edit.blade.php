<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Modifier la permission</h1>
                    <x-forms.update :item="$absence" :fields="$my_fields" type="absence" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
