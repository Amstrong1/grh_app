<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">{{ __('message.list') }}</h1>

                        <x-primary-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                            {{ __('message.create') }}</x-primary-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <div class="p-4">
                                <x-forms.create :fields="$my_fields" type="holding_wage" />
                            </div>
                        </x-modal>
                    </div>

                    <div class="mt-4">
                        <x-tables.default :resources="$holdingWages" :mattributes="$my_attributes" type="holding_wage" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
