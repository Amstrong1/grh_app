<div class="mx-auto py-6 px-4 lg:px-8 hidden lg:block">
    <nav class="relative flex w-full items-center justify-between lg:justify-center py-2 text-neutral-600 dark:text-neutral-300 lg:flex-wrap"
        data-te-navbar-ref>
        <div class="px-2">
            <div class="flex-grow basis-[100%] items-center lg:flex lg:basis-auto text-black"
                id="navbarSupportedContentX" data-te-collapse-item>
                @if (Auth::user()->role === 'superadmin')
                    @include('layouts.partials.superadmin')
                @elseif (Auth::user()->role === 'admin')
                    @include('layouts.partials.admin')
                @elseif (Auth::user()->role == 'supervisor')
                    @include('layouts.partials.supervisor')
                @else
                    @include('layouts.partials.user')
                @endif
            </div>
        </div>
    </nav>
</div>
