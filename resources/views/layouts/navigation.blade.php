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
                    @include('layouts.partials.superadmin')
                @elseif (Auth::user()->role === 'admin')
                    @include('layouts.partials.admin')
                @elseif (Auth::user()->role === 'supervisor')
                    @include('layouts.partials.supervisor')
                @else
                    @include('layouts.partials.user')
                @endif
            </div>
        </div>
    </nav>
</div>
