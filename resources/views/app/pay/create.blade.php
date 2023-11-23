<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>{{ __('message.create') }}</h1>

                    @if (request()->routeIs('pay.create'))
                        <form action="{{ route('pay.store') }}" method="POST">
                            @csrf

                            @livewire('select-employee')

                            <div class="flex items-center justify-end mt-8">
                                <x-primary-button class="ml-4">
                                    {{ __('message.create') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
