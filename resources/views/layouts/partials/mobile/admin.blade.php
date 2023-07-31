<ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref>
    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            href="{{ route('dashboard') }}" data-te-sidenav-link-ref>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>&nbsp;
            Accueil
        </a>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>&nbsp;
                Absences
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('absence.index') }}" data-te-sidenav-link-ref>Permissions en attente
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.allowed') }}" data-te-sidenav-link-ref>Permissions validées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.denied') }}" data-te-sidenav-link-ref>Permissions refusées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.index') }}" data-te-sidenav-link-ref>Modification congés en attente
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.allowed') }}" data-te-sidenav-link-ref>Modification congés validées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.denied') }}" data-te-sidenav-link-ref>Modification congés refusées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.index') }}" data-te-sidenav-link-ref>Attestation travail en attente
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.allowed') }}" data-te-sidenav-link-ref>Attestation travail validées
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('absence.denied') }}" data-te-sidenav-link-ref>Attestation travail refusées
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>&nbsp;
                Tâches
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('task.create') }}" data-te-sidenav-link-ref>Nouvelle tâche
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('task.index') }}" data-te-sidenav-link-ref>Tâches à faire
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('task.finished') }}" data-te-sidenav-link-ref>Tâches finis
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('regular_task.index') }}" data-te-sidenav-link-ref>Tâches finis
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>&nbsp;
                Paies
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('pay.create') }}" data-te-sidenav-link-ref>Nouvelle fiche
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('pay.index') }}" data-te-sidenav-link-ref>Historique des fiches
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525" />
                </svg>&nbsp;
                Congés
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="" data-te-sidenav-link-ref>Planifier
                </x-link>
            </li>
            <li class="relative">
                <x-link href="" data-te-sidenav-link-ref>Voir l'agenda
                </x-link>
            </li>
        </ul>
    </li>

    {{-- <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            :href="route('dashboard')" :active="request()-> routeIs('dashboard')" data-te-sidenav-link-ref>
            Evaluations
        </a>
    </li> --}}

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                </svg>&nbsp;
                Paramètres
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('department.index') }}" data-te-sidenav-link-ref>Départements
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('place.index') }}" data-te-sidenav-link-ref>Postes
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('filler.index') }}" data-te-sidenav-link-ref>Imputations salaires
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('holding_wage.index') }}" data-te-sidenav-link-ref>Imputations salaires
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('salary_advantage.index') }}" data-te-sidenav-link-ref>Avantages salariales
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('leave_type.index') }}" data-te-sidenav-link-ref>Avantages salariales
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>&nbsp;
                Utilisateurs
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('career.index') }}" data-te-sidenav-link-ref>Liste des Employés
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('career.create') }}" data-te-sidenav-link-ref>Ajouter Employé
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('admin.index') }}" data-te-sidenav-link-ref>Listes des Superviseurs
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('admin.create') }}" data-te-sidenav-link-ref>Ajouter Superviseur
                </x-link>
            </li>
        </ul>
    </li>

    <li class="relative">
        <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-white outline-none transition duration-300 ease-linear hover:bg-slate-400 hover:text-inherit hover:outline-none focus:bg-slate-400 focus:text-inherit focus:outline-none active:bg-slate-400 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                </svg>&nbsp;
                Conflits
            </span>
            <span
                class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-white dark:[&>svg]:text-gray-300"
                data-te-sidenav-rotate-icon-ref>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </a>

        <ul class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block"
            data-te-sidenav-collapse-ref>
            <li class="relative">
                <x-link href="{{ route('conflict.create') }}" data-te-sidenav-link-ref>Nouveau conflit
                </x-link>
            </li>
            <li class="relative">
                <x-link href="{{ route('conflict.index') }}" data-te-sidenav-link-ref>Liste des conflits
                </x-link>
            </li>
        </ul>
    </li>
</ul>
