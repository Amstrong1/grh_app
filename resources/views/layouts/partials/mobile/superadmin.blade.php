<!--Tabs navigation-->
<ul class="lg:hidden flex list-none flex-row border-b-0 pl-0 overflow-scroll" style="background-color: #03224c">
    <li>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Accueil
        </x-nav-link>
    </li>

    <li>
        <button onclick="openDropdown(event, 'conge')"
            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-white hover:isolate hover:border-transparent hover:bg-neutral-300 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">
            Structures
        </button>
        <div id="conge"
            class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mb-1">
            <x-nav-link href="{{ route('structure.index') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Liste
            </x-nav-link>
            <div class="h-0 my-2 border border-solid border-t-0 border-slate-800 opacity-25"></div>
            <x-nav-link href="{{ route('structure.create') }}"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700">
                Ajouter Nouveau
            </x-nav-link>
        </div>
    </li>
</ul>
