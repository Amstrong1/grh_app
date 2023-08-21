<!--Tabs navigation-->
<ul class="lg:hidden flex list-none flex-row border-b-0 pl-0 overflow-scroll" style="background-color: #03224c">
    <li>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Accueil
        </x-nav-link>
    </li>

    <li>
        <x-nav-link :href="route('career.show', [Auth::user()->career->id])" :active="request()->routeIs('career.*')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Carrière
        </x-nav-link>
    </li>

    <li>
        <x-nav-link :href="route('attendance_log.index')" :active="request()->routeIs('attendance_log.*')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Pointages
        </x-nav-link>
    </li>

    <li>
        <button onclick="openDropdown(event, 'absence')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Demandes
        </button>
        <div id="absence"
            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('absence.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Permissions en attente
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('absence.allowed') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Permissions validées
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('absence.denied') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Permissions refusées
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Autres demandes
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'tache')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Tâches
        </button>
        <div id="tache"
            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('task.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Nouvelle tâche
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Tâches à faire
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.finished') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Tâches finis
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('regular_task.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Tâches régulières
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'conge')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Congés
        </button>
        <div id="conge"
            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('leave.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Planifier
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('leave.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Voir l'agenda
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'user')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Utilisateurs
        </button>
        <div id="user"
            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('career.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Liste des Employés
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('career.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Ajouter Employé
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'conflit')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Conflits
        </button>
        <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
            id="conflit">
            <x-nav-link href="{{ route('conflict.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Nouveau conflit
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('conflict.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Liste des conflits
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'recruitment')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Recutement
        </button>
        <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
            id="recruitment">
            <x-nav-link href="{{ route('coming-soon') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Nouveau conflit
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('coming-soon') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Liste des conflits
            </x-nav-link>
        </div>
    </li>
</ul>
