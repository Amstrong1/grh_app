<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-semibold text-lg m-4">
                            {{ __('E-GRH TABLEAU DE BORD') }}
                        </h1>

                        @if (Auth::user()->role !== 'superadmin')
                            <form action="{{ route('absence.index') }}" method="POST">
                                @csrf
                                <div class="md:flex text-sm mx-2">
                                    <div class="p-2">
                                        <span>Période du</span>
                                        <input
                                            class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg"
                                            type="date" name="start" value="{{ request()->start }}">
                                        <span>
                                            au
                                        </span>
                                        <input
                                            class="p-2 border-gray-300 border-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-lg"
                                            type="date" name="end" value="{{ request()->end }}">
                                        <x-secondary-button class="py-3 border-gray-300 border-2 shadow-lg"
                                            type="submit">
                                            Appliquer
                                        </x-secondary-button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                    @if (Auth::user()->role === 'superadmin')
                        <!-- Cards -->
                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Structures : {{ $structures }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('structure.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'admin')
                        <!-- Cards -->
                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Nombre de départements : {{ $departments }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('department.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Nombre de postes : {{ $places }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('place.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Nombre d'utilisateurs : {{ $users }}
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                    </p>
                                    <hr>
                                    <p
                                        class="inline-block align-baseline mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('career.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Conflits signalés : {{ $conflicts }}
                                    </p>
                                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                    </p>
                                    <hr>
                                    <p
                                        class="inline-block align-baseline mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('conflict.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Permissionnaires : {{ $absences }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('absence.index') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Tâches en cours : {{ $tasks }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('task.pending') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Sanctions : {{ $sanctions }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">

                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Motivations : {{ $rewards }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Tâches en cours : {{ $tasks }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('task.pending') }}">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Sanctions : {{ $sanctions }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">

                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Motivations : {{ $rewards }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="flex p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <div
                                    class="w-10 h-10 p-2 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        Solde Congés : {{ $sold }}
                                    </p>
                                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    </p>
                                    <hr>
                                    <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                        <a href="">Voir plus</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
