<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon_io/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        input, .select2-container .select2-selection--single, .select2-container .select2-selection--multiple {
            height: 44px;
        }
        .select2-container .select2-selection--single, .select2-container .select2-selection--multiple {
            border-color: #e5e7eb;
            border-width: 2px;
            padding-top: 8px;
            margin-top: 4px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            top: 90%;
            left: 0;
        }
    </style>

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">

        <!-- Page Heading -->
        <header class="bg-white text-white shadow" style="background-color: #03224c">
            @include('layouts.navigation-top')
            @include('layouts.navigation')
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <footer class="w-full">

        </footer>
    </div>

    @include('sweetalert::alert')
    @livewireScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script defer src="{{ asset('js/twe-script.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>

</body>

</html>
