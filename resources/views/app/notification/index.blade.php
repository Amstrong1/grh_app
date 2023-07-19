<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">Notifications</h1>

                        <div>
                            <x-primary-button>
                                <a href="{{ route('notification.markAsRead') }}">Tout marquer comme lu</a>
                            </x-primary-button>

                            <x-danger-button>
                                <a href="{{ route('notification.remove') }}">Tout supprimer</a>
                            </x-danger-button>
                        </div>
                    </div>
                    @foreach (auth()->user()->notifications as $notification)
                        <div class="p-2">
                            {{ $notification->data['message'] . ', le ' . getFormattedDateTime($notification->created_at) }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
