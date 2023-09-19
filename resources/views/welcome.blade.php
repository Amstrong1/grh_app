<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RH-IA</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            corePlugins: {
                preflight: false,
            },
        };
    </script>

    <style>
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

</head>

<body>
    <!-- Navigation bar -->

    <header class="w-full min-h-screen bg-fixed bg-center bg-cover"
        style="background-image:url('assets/img/hero.jpg');">

        <div style="background-color: rgba(3, 34, 76, .8)" class="min-h-screen px-4">
            <nav class="flex w-full items-center justify-between py-2 md:flex-wrap md:justify-start" data-te-navbar-ref>
                <div class="flex w-full flex-wrap items-center justify-between px-1 md:px-3">

                    <!-- Navigation links -->
                    <div class="grow basis-[100%] items-center !flex lg:basis-auto">

                        <div class="w-full container mx-auto px-2 md:px-6 py-2">

                            <div class="w-full flex items-center justify-between">
                                <div>
                                    <a class="flex items-center no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                                        href="/">
                                        <img class="w-14 rounded-full" src="{{ asset('assets/img/eGRH.png') }}"
                                            alt="eGRH">
                                    </a>
                                </div>

                                <div class="hidden md:flex md:flex-row justify-end content-center">
                                    <a class="flex text-white no-underline hover:text-indigo-200 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4"
                                        href="{{ route('coming-soon') }}" data-te-nav-link-ref data-te-ripple-init
                                        data-te-ripple-color="light">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg> &nbsp;
                                        A Propos
                                    </a>

                                    <a class="flex text-white no-underline hover:text-indigo-200 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4"
                                        href="{{ route('coming-soon') }}" data-te-nav-link-ref data-te-ripple-init
                                        data-te-ripple-color="light">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                        </svg> &nbsp;
                                        FAQs
                                    </a>
                                </div>

                                <!-- Sidenav -->
                                <nav id="sidenav-7"
                                    class="fixed right-0 z-[1035] h-screen w-60 translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] data-[te-sidenav-hidden='false']:-translate-x-0 dark:bg-zinc-800"
                                    style="top: 7rem" data-te-sidenav-init data-te-sidenav-hidden="true"
                                    data-te-sidenav-right="true">
                                    <ul class="relative m-0 list-none px-[0.2rem]" data-te-sidenav-menu-ref>
                                        <li class="relative">
                                            <a class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                                                data-te-sidenav-link-ref>
                                                <span
                                                    class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                </span>
                                                <span>A Propos</span>
                                            </a>
                                        </li>
                                    </ul>
                                    {{-- </nav> --}}
                                    <!-- Sidenav -->

                                    <!-- Toggler -->
                                    <button
                                        class="border-0 bg-transparent px-2 text-xl leading-none transition-shadow duration-150 ease-in-out hover:text-white focus:text-white dark:hover:text-white dark:focus:text-white lg:hidden">
                                        <span class="block [&>svg]:h-5 [&>svg]:w-6 [&>svg]:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                            </svg> &nbsp;
                                            A Propos
                                        </span>
                                    </button>
                                    <!-- Toggler -->
                            </div>

                        </div>
                    </div>
                </div>
            </nav>

            <div class="px-8 md:px-14 mx-auto flex flex-wrap flex-col md:flex-row items-center">

                <div class="flex flex-col w-full justify-center items-center lg:items-start py-4">
                    <div class="xl:w-2/5">
                        <h1
                            class="my-4 text-3xl md:text-4xl text-white font-bold leading-tight text-center md:text-left slide-in-bottom-h1">
                            RH-IA, votre partenaire RH en progrès</h1>
                        <p
                            class="leading-normal text-base text-white md:text-md mb-8 text-center md:text-left slide-in-bottom-subtitle">
                            Vivifiez vos ressources humaines avec l'automatisation intelligente.
                        </p>

                        <a class="m-2" href="{{ route('dashboard') }}">
                            <button class="uppercase text-md font-semibold my-8 rounded-full py-1 px-6"
                                style="color: #fb8c00; border: #fb8c00 solid 2px">
                                Connexion
                            </button>
                        </a>

                        <a class="m-2" href="">
                            <button class="uppercase text-white text-md font-semibold rounded-full py-1 px-6"
                                style="background-color: #fb8c00">
                                CONTACTEZ-NOUS
                            </button>
                        </a>
                    </div>

                    <div class="w-full fade-in flex items-center my-8">
                        <div class="w-1/3 md:w-1/5 h-10 flex items-center justify-center"
                            style="background-color: #ff9800">
                            <h2 class="font-bold text-sm md:text-md">Avis d'information</h2>
                        </div>
                        <div class="bg-white w-2/3 md:w-4/5 h-10 flex items-center">
                            <marquee behavior="" direction="">
                                Votre plateforme est actuellement en maintenance, veuillez vous abonner à notre newsletter pour être informer dès le lancement.
                            </marquee>
                        </div>
                    </div>

                    <div
                        class="flex flex-col md:grid md:grid-cols-3 w-full items-baseline md:justify-between pt-6 lg:pb-0 fade-in">
                        <div class="m-2 flex justify-center">
                            <h4 class="text-white font-semibold text-center"></h4>
                            <div class="relative top-16 flex">
                                <img src="{{ asset('assets/img/vibecro.png') }}" class="h-12 m-2 bounce-top-icons">
                                <img src="{{ asset('assets/img/playstore.svg') }}" class="h-12 m-2 bounce-top-icons">
                            </div>
                        </div>

                        <div class="m-2">
                            <h4 class="text-white font-semibold text-center">Suivez nous</h4>
                            <div class="mt-4 flex justify-center items-center">
                                <span class="mx-2"> <img src="{{ asset('assets/img/whatsapp.svg') }}"
                                        alt="whatsapp">
                                </span>
                                <span class="mx-2"> <img src="{{ asset('assets/img/facebook.svg') }}"
                                        alt="facebook">
                                </span>
                                <span class="mx-2"> <img src="{{ asset('assets/img/twitter.svg') }}"
                                        alt="twitter">
                                </span>
                                <span class="mx-2"> <img src="{{ asset('assets/img/linkedIn.svg') }}"
                                        alt="linkedIn">
                                </span>
                            </div>
                        </div>

                        <div class="m-2 flex flex-col">
                            <form action="" method="post">
                                <h4 class="text-white font-semibold text-center">Abonnez vous à notre newsletter</h4>
                                <div class="relative mt-4 flex flex-wrap items-stretch">
                                    @csrf
                                    <input type="mail"
                                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-white bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-white outline-none transition duration-200 ease-in-out focus:z-[3] focus:outline-none"
                                        placeholder="Email" aria-label="Email" aria-describedby="button-addon2" />
                                    <button
                                        class="z-[2] inline-block rounded-r bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:z-[3] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                                        data-te-ripple-init type="submit" id="button-addon2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>
