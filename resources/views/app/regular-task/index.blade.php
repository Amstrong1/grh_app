<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">{{ __('message.list') }}</h1>
                        @if (Auth::user()->role == 'user')
                            <x-primary-button>
                                <a href="{{ route('regular_task_report.create') }}">{{ __('message.report') }}</a>
                            </x-primary-button>
                        @else
                            <a href="{{ route('regular_task.create') }}">
                                <x-primary-button>
                                    {{ __('message.create') }}
                                </x-primary-button>
                            </a>
                        @endif
                    </div>
                    <div class="mt-4">
                        <x-tables.default :resources="$regularTasks" :mattributes="$my_attributes" type="regular_task" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
