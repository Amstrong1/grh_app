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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <!-- Scripts -->

    <script>
        tailwind.config = {
            darkMode: "class",
            corePlugins: {
                preflight: false,
            },
        };
    </script>

    @laravelPWA
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="w-full min-h-screen bg-fixed bg-center bg-cover" style="background-image:url('assets/img/hero.jpg');">

        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6 sm:pt-0"
            style="background-color: rgba(3, 34, 76, .8)">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <div class="text-center py-6">
                    <div class="w-16 mx-auto">
                        <a href="/">
                            <x-application-logo class="fill-current text-gray-500" />
                        </a>
                    </div>
                    <h1 class="mb-12 mt-1 pb-1 text-md font-semibold">
                        Bienvenu sur RH-IA, votre plateforme de gestion de ressources humaines
                    </h1>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    @include('sweetalert::alert')

    <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script async src="//www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("form").submit();
        }

        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>
