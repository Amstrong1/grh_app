<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 hidden lg:block">
    <nav class="relative flex w-full items-center justify-between py-2 text-neutral-600 dark:text-neutral-300 lg:flex-wrap lg:justify-start"
        data-te-navbar-ref>
        <div class="px-6">
            <div class="flex-grow basis-[100%] items-center lg:!flex lg:basis-auto text-white" id="navbarSupportedContentX"
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

<!-- Sidenav -->
<nav id="sidenav-5"
    class="lg:hidden fixed left-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] data-[te-sidenav-hidden='false']:translate-x-0 dark:bg-zinc-800"
    data-te-sidenav-init data-te-sidenav-hidden="false" data-te-sidenav-accordion="true" style="background-color: #03224c">

    @if (Auth::user()->role === 'superadmin')
        @include('layouts.partials.mobile.superadmin')
    @elseif (Auth::user()->role === 'admin')
        @include('layouts.partials.mobile.admin')
    @elseif (Auth::user()->role === 'supervisor')
        @include('layouts.partials.mobile.supervisor')
    @else
        @include('layouts.partials.mobile.user')
    @endif

</nav>
<!-- Sidenav -->

<!-- Toggler -->
<x-primary-button class="lg:hidden m-4" data-te-sidenav-toggle-ref data-te-target="#sidenav-5" aria-controls="#sidenav-5"
    aria-haspopup="true">
    <span class="block [&>svg]:h-5 [&>svg]:w-5 [&>svg]:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
            <path fill-rule="evenodd"
                d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                clip-rule="evenodd" />
        </svg>
    </span>
</x-primary-button>
<!-- Toggler -->
