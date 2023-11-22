<!--Tabs navigation-->
<ul class="lg:hidden flex list-none flex-row border-b-0 pl-0 overflow-scroll md:justify-center"
    style="background-color: #e9e9e9">
    <li>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Accueil
            </div>
        </x-nav-link>
    </li>

    {{-- absence --}}
    <li>
        <button onclick="openDropdown(event, 'absence')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
                Demandes
            </div>
        </button>
        <div id="absence"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
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
                Demandes recus
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation.sent') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Demandes envoyés
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation_back.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Réponses demandes recus
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation_back.sent') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Réponses demandes envoyés
            </x-nav-link>
        </div>
    </li>

    {{-- vacation --}}
    <li>
        <button onclick="openDropdown(event, 'conge')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525" />
                </svg>
                Congés
            </div>
        </button>
        <div id="conge"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
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

    {{-- conflict --}}
    <li>
        <button onclick="openDropdown(event, 'conflit')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                </svg>
                Conflits
            </div>
        </button>
        <div class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
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

    {{-- logistic --}}
    <li>
        <x-nav-link :href="route('coming-soon')" :active="request()->routeIs('attendance_log.*')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                </svg>
                Logistique
            </div>
        </x-nav-link>
    </li>

    {{-- pay --}}
    <li>
        <button onclick="openDropdown(event, 'paie')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
                Paies
            </div>
        </button>
        <div id="paie"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('pay.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Nouvelle fiche
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('pay.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Historique des fiches
            </x-nav-link>
        </div>
    </li>

    {{-- user --}}
    <li>
        <button onclick="openDropdown(event, 'user')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Utilisateurs
            </div>
        </button>
        <div id="user"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('career.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Liste des Employés
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('career.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Ajouter Employé
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('admin.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Listes des Superviseurs
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('admin.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Ajouter Superviseur
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('attendance_log.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Pointages
            </x-nav-link>
        </div>
    </li>

    {{-- task --}}
    <li>
        <button onclick="openDropdown(event, 'task')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                Tâches
            </div>
        </button>
        <div id="task"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('task.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Nouvelle tâche
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('regular_task.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Tâches à faire
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.pending') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Tâches en cours
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

    {{-- recruitment --}}
    {{-- <li>
        <button onclick="openDropdown(event, 'recruitment')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                </svg>
                Recrutement
            </div>
        </button>
        <div class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
            id="recruitment">
            <x-nav-link href="{{ route('coming-soon') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Interne
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('coming-soon') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Externe
            </x-nav-link>
        </div>
    </li> --}}

    {{-- settings --}}
    <li>
        <button onclick="openDropdown(event, 'setting')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-black hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                </svg>
                Paramètres
            </div>
        </button>
        <div id="setting"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('department.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Départements
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('place.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Postes
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('filler.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Imputations salaires
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('holding_wage.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Retenues salaires
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('salary_advantage.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Avantages salaires
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('leave_type.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Types Congés
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('reader.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Lecteur d'accès
            </x-nav-link>
        </div>
    </li>
</ul>
