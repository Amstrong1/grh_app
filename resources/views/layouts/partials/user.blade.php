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
            href="#" data-te-ripple-init data-te-ripple-color="light" type="button" id="dropdownMenuButtonX"
            data-te-dropdown-toggle-ref aria-expanded="false" data-te-nav-link-ref>Absences
            <span class="ml-2 w-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
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
            href="#" data-te-ripple-init data-te-ripple-color="light" type="button" id="dropdownMenuButtonX"
            data-te-dropdown-toggle-ref aria-expanded="false" data-te-nav-link-ref>Conflits
            <span class="ml-2 w-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
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
            :href="route('career.show', [Auth::user()->career->id])" :active="request()->routeIs('career.*')" data-te-ripple-init data-te-ripple-color="light">
            Carrière
        </x-nav-link>
    </li>

    <li class="static" data-te-nav-item-ref data-te-dropdown-ref>
        <x-nav-link :active="request()->routeIs('task.*')"
            class="flex items-center whitespace-nowrap py-2 pr-2  transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white lg:px-2"
            href="#" data-te-ripple-init data-te-ripple-color="light" type="button" id="dropdownMenuButtonX"
            data-te-dropdown-toggle-ref aria-expanded="false" data-te-nav-link-ref>Tâches
            <span class="ml-2 w-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
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
                        <x-nav-link href="{{ route('task.index') }}" aria-current="true"
                            class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                            Tâches à faire
                        </x-nav-link>
                    </div>
                    <div>
                        <x-nav-link href="{{ route('task.pending') }}" aria-current="true"
                            class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                            Tâches en cours
                        </x-nav-link>
                    </div>
                    <div>
                        <x-nav-link href="{{ route('task.finished') }}" aria-current="true"
                            class="block w-full border-b border-neutral-200 px-6 py-2 transition duration-150 ease-in-out hover:bg-neutral-50 hover:text-neutral-700 dark:border-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-white">
                            Tâches finis
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
            :href="route('notification')" :active="request()->routeIs('notification')" data-te-ripple-init data-te-ripple-color="light">
            Notifications
            <span
                class="inline-block whitespace-nowrap rounded-[0.27rem] bg-primary-100 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-top text-[0.75em] font-bold leading-none text-primary-700">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        </x-nav-link>
    </li>
</ul>
