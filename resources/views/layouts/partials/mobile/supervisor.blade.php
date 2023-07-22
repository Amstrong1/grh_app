<ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref>
    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            :href="route('dashboard')" :active="request()-> routeIs('dashboard')" data-te-sidenav-link-ref>
            Accueil
        </a>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Absences</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('absence.create') }}"
                    data-te-sidenav-link-ref>Nouvelle permission
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.index') }}"
                    data-te-sidenav-link-ref>Permissions en attente
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.allowed') }}"
                    data-te-sidenav-link-ref>Permissions validées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.denied') }}"
                    data-te-sidenav-link-ref>Permissions refusées
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Conflits</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('conflict.create') }}"
                    data-te-sidenav-link-ref>Nouveau conflit
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('conflict.index') }}"
                    data-te-sidenav-link-ref>Liste des conflits
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Tâches</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('task.create') }}"
                    data-te-sidenav-link-ref>Nouvelle tâche
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('task.index') }}"
                    data-te-sidenav-link-ref>Tâches à faire
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('task.finished') }}"
                    data-te-sidenav-link-ref>Tâches finis
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Paies</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('pay.create') }}"
                    data-te-sidenav-link-ref>Nouvelle fiche
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('pay.index') }}"
                    data-te-sidenav-link-ref>Historique des fiches
                </x-link>
            </li>
        </ul>
    </li>

    {{-- <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            :href="route('dashboard')" :active="request()-> routeIs('dashboard')" data-te-sidenav-link-ref>
            Evaluations
        </a>
    </li> --}}

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Paramètres</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('department.index') }}"
                    data-te-sidenav-link-ref>Départements
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('place.index') }}"
                    data-te-sidenav-link-ref>Postes
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('filler.index') }}"
                    data-te-sidenav-link-ref>Imputations salaires
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('salaryAdvantage.index') }}"
                    data-te-sidenav-link-ref>Avantages salariales
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span>Utilisateurs</span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('career.index') }}"
                    data-te-sidenav-link-ref>Liste des Employés
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('career.create') }}"
                    data-te-sidenav-link-ref>Ajouter Employé
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('admin.index') }}"
                    data-te-sidenav-link-ref>Listes des Superviseurs
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('admin.create') }}"
                    data-te-sidenav-link-ref>Ajouter Superviseur
                </x-link>
            </li>
        </ul>
    </li>
</ul>
