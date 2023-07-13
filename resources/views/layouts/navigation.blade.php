<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <nav class="relative flex w-full items-center justify-between py-2 text-neutral-600 dark:text-neutral-300 lg:flex-wrap lg:justify-start"
        data-te-navbar-ref>
        <div class="px-6">
            <button
                class="sm:hidden border-0 bg-transparent py-3 text-xl leading-none transition-shadow duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white"
                type="button" data-te-collapse-init data-te-target="#navbarSupportedContentX"
                aria-controls="navbarSupportedContentX" aria-expanded="false" aria-label="Toggle navigation">
                <span class="[&>svg]:w-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </span>
            </button>

            <div class="flex-grow basis-[100%] items-center lg:!flex lg:basis-auto" id="navbarSupportedContentX"
                data-te-collapse-item>
                @if (Auth::user()->role === 'superadmin')
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                Accueil
                            </x-nav-link>
                        </li>

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>
                            <x-nav-link
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Structure
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('structure.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Liste
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('structure.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Ajouter
                                                Nouveau</x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @elseif (Auth::user()->role === 'admin')
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                Accueil
                            </x-nav-link>
                        </li>

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>
                            
                            <x-nav-link :active="request()->routeIs('absence.*')"
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Absences
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('absence.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Nouvelle permission
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('absence.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Liste des permissions
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('absence.pending') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Permissions en attente
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('absence.allowed') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Permissions validées
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('absence.denied') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Permissions refusées
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>                       

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>                            
                            <x-nav-link :active="request()->routeIs('conflict.*')"
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Conflits
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('conflict.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Nouveau conflit
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('conflict.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Liste des conflits
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Paies
                            </x-nav-link>
                        </li>

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>                            
                            <x-nav-link :active="request()->routeIs('task.*')"
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Tâches
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('task.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Nouvelle tâche
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('task.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Liste des tâches
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Evaluations
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Notifications
                            </x-nav-link>
                        </li>

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>
                            <x-nav-link
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Paramètres
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('department.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Départements
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('place.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Postes
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('filler.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Imputations salaires
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="static" data-te-nav-item-ref data-te-dropdown-ref>
                            <x-nav-link
                                class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                href="#" data-te-ripple-init data-te-ripple-color="light" type="button"
                                id="dropdownMenuButtonX" data-te-dropdown-toggle-ref aria-expanded="false"
                                data-te-nav-link-ref>Utilisateurs
                                <span class="ml-2 w-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </x-nav-link>

                            <div class="absolute left-0 right-0 top-full z-[1000] mt-0 hidden w-full border-none bg-white bg-clip-padding text-neutral-600 shadow-lg dark:bg-neutral-700 dark:text-neutral-200 [&[data-te-dropdown-show]]:block"
                                aria-labelledby="dropdownMenuButtonX" data-te-dropdown-menu-ref>
                                <div class="px-6 py-5 lg:px-8">
                                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                                        <div>
                                            <x-nav-link href="{{ route('admin.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Listes des Superviseurs
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('admin.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Ajouter Superviseur
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('career.index') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Liste des Employés
                                            </x-nav-link>
                                        </div>
                                        <div>
                                            <x-nav-link href="{{ route('career.create') }}" aria-current="true"
                                                class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                                                Ajouter Employé
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @elseif (Auth::user()->role === 'supervisor')
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                Accueil
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Absences
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Carrière
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Conflits
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Tâches
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Evaluations
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Notifications
                            </x-nav-link>
                        </li>
                    </ul>
                @else
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                Accueil
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Absences
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Carrière
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Conflits
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Tâches
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Evaluations
                            </x-nav-link>
                        </li>

                        <li data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('absence')" data-te-ripple-init data-te-ripple-color="light">
                                Notifications
                            </x-nav-link>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>
