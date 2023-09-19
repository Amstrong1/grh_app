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
        input,
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: 44px;
        }

        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            border-color: #e5e7eb;
            border-width: 2px;
            padding-top: 8px;
            margin-top: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            top: 90%;
            left: 0;
        }

        @font-face {
            font-family: montserrat;
            src: url('/assets/font/montserrat.ttf');
        }

        @font-face {
            font-family: raleway;
            src: url('/assets/font/raleway.ttf');
        }

        body {
            font-family: raleway
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: montserrat
        }
    </style>

    @laravelPWA

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            corePlugins: {
                preflight: false,
            },
        };
    </script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>
</head>

<body class="font-sans antialiased">
    <!-- Page Heading -->
    <header class="fixed z-50 w-full bg-white text-white shadow" style="background-color: #03224c">
        @include('layouts.navigation-top')
        @include('layouts.navigation')
    </header>

    <div class="w-full min-h-screen bg-fixed bg-center bg-cover flex flex-col sm:justify-center items-center"
        style="background-image:url('assets/img/hero.jpg');">

        <div class="w-full min-h-screen" style="background-color: rgba(3, 34, 76, .8)">
            <div class="relative top-20 md:top-32">
                <!-- Page Content -->
                <main class="pb-12">
                    {{ $slot }}
                </main>

                <footer class="fixed bottom-0 w-full">
                    @include('layouts.navigation-bottom')
                </footer>
            </div>
        </div>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
