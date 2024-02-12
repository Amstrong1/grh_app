<!--Tabs navigation-->
<ul class="lg:hidden flex list-none flex-row border-b-0 pl-0 overflow-scroll md:justify-center"
    style="background-color: #03224c">
    <li>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                {{ __('message.home') }}
            </div>
        </x-nav-link>
    </li>

    <li>
        <x-nav-link :href="route('career.show', [Auth::user()->career->id])" :active="request()->routeIs('career.*')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
                {{ __('message.career') }}
            </div>
        </x-nav-link>
    </li>

    <li>
        <x-nav-link :href="route('attendance_log.index')" :active="request()->routeIs('attendance_log.*')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
                {{ __('message.score') }}
            </div>
        </x-nav-link>
    </li>

    <li>
        <button onclick="openDropdown(event, 'absence')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
                {{ __('message.asks') }}
            </div>
        </button>
        <div id="absence"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('absence.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.create_permission') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('absence.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.permissions_pending') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('absence.allowed') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.permissions_allowed') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('absence.denied') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.permissions_denied') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.permissions_received') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation.sent') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.permissions_sent') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation_back.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.responses_received') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('temptation_back.sent') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.responses_sent') }}
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'tache')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                {{ __('message.tasks') }}
            </div>
        </button>
        <div id="tache"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('task.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.create') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.tasks') }} {{ __('message.to_do') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.pending') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.tasks') }} {{ __('message.pending') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('task.finished') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.tasks') }} {{ __('message.done') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('regular_task.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.tasks') }} {{ __('message.regular') }}
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'conge')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.893 13.393l-1.135-1.135a2.252 2.252 0 01-.421-.585l-1.08-2.16a.414.414 0 00-.663-.107.827.827 0 01-.812.21l-1.273-.363a.89.89 0 00-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 01-1.81 1.025 1.055 1.055 0 01-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 01-1.383-2.46l.007-.042a2.25 2.25 0 01.29-.787l.09-.15a2.25 2.25 0 012.37-1.048l1.178.236a1.125 1.125 0 001.302-.795l.208-.73a1.125 1.125 0 00-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 01-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 01-1.458-1.137l1.411-2.353a2.25 2.25 0 00.286-.76m11.928 9.869A9 9 0 008.965 3.525m11.928 9.868A9 9 0 118.965 3.525" />
                </svg>
                {{ __('message.leaves') }}
            </div>
        </button>
        <div id="conge"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('leave.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.view_agenda') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('leave.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.plan') }}
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'user')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                {{ __('message.staff') }}
            </div>
        </button>
        <div id="user"
            class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('career.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.employee_list') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('career.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.employee_add') }}
            </x-nav-link>
        </div>
    </li>

    <li>
        <button onclick="openDropdown(event, 'conflit')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                </svg>
                {{ __('message.conflicts') }}
            </div>
        </button>
        <div class="dropup hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1"
            id="conflit">
            <x-nav-link href="{{ route('conflict.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.report') }}
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('conflict.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                {{ __('message.list') }}
            </x-nav-link>
        </div>
    </li>

    {{-- <li>
        <button onclick="openDropdown(event, 'recruitment')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
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
</ul>
