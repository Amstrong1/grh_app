<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-bold text-lg my-2">
                            {{ __('message.asks') }}
                            @if (request()->routeIs('temptation.index'))
                                {{ __('message.create') }}
                            @elseif (request()->routeIs('temptation.sent'))
                                {{ __('message.sent') }}
                            @endif
                        </h1>

                        @if (request()->routeIs('temptation.sent'))
                            <a href="{{ route('temptation.create') }}">
                                <x-primary-button>
                                    {{ __('message.create') }}
                                </x-primary-button>
                            </a>
                        @endif
                    </div>

                    <x-forms.filter :action="route('temptation.filter')" />

                    <div class="mt-4">
                        <x-tables.default :resources="$temptations" :mattributes="$my_attributes" type="temptation" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
