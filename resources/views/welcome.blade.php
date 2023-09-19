<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-GRH</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
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

    <header class="w-full md:h-screen bg-fixed bg-center bg-cover" style="background-image:url('assets/img/hero.jpg');">

        <div style="background-color: rgba(3, 34, 76, .8)" class="h-full">
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
                                        href="" data-te-nav-link-ref data-te-ripple-init
                                        data-te-ripple-color="light">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg> &nbsp;
                                        A Propos
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
                            E-GRH, votre partenaire RH en progrès</h1>
                        <p
                            class="leading-normal text-base text-white md:text-md mb-8 text-center md:text-left slide-in-bottom-subtitle">
                            Découvrez le trio gagnant de l'efficacité, de l'engagement des employés et de l'excellence
                            opérationnelle avec notre application de gestion des ressources humaines simplifiée.
                        </p>

                        <a href="{{ route('dashboard') }}">
                            <button class="uppercase text-md font-semibold my-8 rounded-full py-1 px-6"
                                style="color: #fb8c00; border: #fb8c00 solid 2px">
                                Connexion
                            </button>
                        </a>
                    </div>

                    <div class="w-full fade-in flex items-center mx-8">
                        <div class="w-1/3 md:w-1/4 h-10 flex items-center justify-center" style="background-color: #ff9800">
                            <h2 class="font-bold text-sm md:text-md">Avis d'information</h2>
                        </div>
                        <div class="bg-white w-2/3 md:w-3/4 h-10 flex items-center">
                            <marquee behavior="" direction="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus possimus voluptatem
                                quod
                                facilis dolorem reiciendis sunt deserunt illo inventore voluptas eum fuga itaque eaque
                                asperiores magni, hic qui? Atque, libero!
                            </marquee>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row w-full items-center md:justify-between pt-12 lg:pb-0 fade-in">
                        <div class="m-2">
                            <img src="{{ asset('assets/img/vibecro.jpg') }}" class="h-12 pr-4 bounce-top-icons">
                        </div>
                        <div class="m-2">
                            <a href="">
                                <button class="uppercase text-white text-md font-semibold rounded-full py-1 px-6"
                                    style="background-color: #fb8c00">
                                    CONTACTEZ-NOUS
                                </button>
                            </a>
                        </div>
                        <div class="m-2 flex justify-between items-center">
                            <span class="mx-2"> <img src="{{ asset('assets/img/whatsapp.svg') }}" alt="whatsapp">
                            </span>
                            <span class="mx-2"> <img src="{{ asset('assets/img/facebook.svg') }}" alt="facebook">
                            </span>
                            <span class="mx-2"> <img src="{{ asset('assets/img/twitter.svg') }}" alt="twitter">
                            </span>
                            <span class="mx-2"> <img src="{{ asset('assets/img/linkedin.svg') }}" alt="linkedin">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>
