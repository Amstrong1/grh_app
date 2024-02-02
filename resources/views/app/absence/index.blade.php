<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">
                            {{ __('message.abs_permissions') }}
                            @if (request()->routeIs('absence.allowed'))
                                {{ __('message.allowed') }}
                            @elseif (request()->routeIs('absence.denied'))
                                {{ __('message.denied') }}
                            @elseif (request()->routeIs('absence.index'))
                                {{ __('message.pending') }}
                            @endif
                        </h1>

                        <a href="{{ route('absence.create') }}">
                            <x-primary-button>
                                {{ __('message.create') }}
                            </x-primary-button>
                        </a>
                    </div>

                    @if (request()->routeIs('absence.allowed'))
                        <x-forms.filter :action="route('absence.allowed.filter')" />
                    @elseif (request()->routeIs('absence.denied'))
                        <x-forms.filter :action="route('absence.denied.filter')" />
                    @elseif (request()->routeIs('absence.index'))
                        <x-forms.filter :action="route('absence.filter')" />
                    @endif

                    <div class="mt-4">
                        <x-tables.default :resources="$absences" :mattributes="$my_attributes" type="absence" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
