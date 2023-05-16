<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" sizes="114x114" href="{{ asset('storage/img/dbu-logo.png') }}">
    {{-- <title>{{ config('app.name', 'DBUOES') }}</title> --}}
    <title>DBU Online Exam System</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div x-data="mainState" :class="{ dark: isDarkMode }" x-on:resize.window="handleWindowResize" x-cloak>
        <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">

            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen" :class="{ 'md:ml-16': !isSidebarOpen }">

                <!-- Navbar -->
                <nav aria-label="secondary" x-data="{ open: false }"
                    class="sticky top-0 z-10 flex items-center justify-between px-4 py-3 sm:px-6 transition-transform duration-500 bg-gray-100 dark:bg-dark-eval-0"
                    :class="{
                        '-translate-y-full': scrollingDown,
                        'translate-y-0': scrollingUp,
                    }">


                    <div>
                        <a href="{{ url('/') }}">

                            <div
                                class="inline-flex items-center gap-2 font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">

                                <div class="w-10  ...">
                                    <x-application-logo aria-hidden="true" />
                                </div>

                                <div class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline
                                focus:outline-2 focus:rounded-sm focus:outline-cyan-500">

                                    DBU Online Exmination System
                                </div>
                            </div>
                            <span class="sr-only">Dashboard</span>
                        </a>

                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <div>
                            @if (Route::has('login'))
                            <div class="pr-0">
                                @auth
                                @if (Auth::user()->role->name == 'Admin')
                                <a href="{{ url('/admin') }}"
                                    class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                                    Dashboard</a>
                                @endif
                                @if (Auth::user()->role->name == 'Teacher')
                                <a href="{{ url('/teacher') }}"
                                    class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                                    Dashboard</a>
                                @endif
                                @if (Auth::user()->role->name == 'Evaluator')
                                <a href="{{ url('/evaluator') }}"
                                    class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                                    Dashboard</a>
                                @endif
                                @if (Auth::user()->role->name == 'Student')
                                <a href="{{ url('/student') }}"
                                    class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                                    Dashboard</a>
                                @endif

                                @else
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">Log
                                    in</a>
                                @if (Route::has('register') && \App\Models\User::count() == 0)
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">Register</a>
                                @endif
                                @endauth
                            </div>
                            @endif
                        </div>


                        <div class="flex items-center gap-3">
                            <x-button type="button" class="hidden md:inline-flex" icon-only variant="secondary"
                                sr-text="Toggle dark mode" x-on:click="toggleTheme">
                                <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6" />

                                <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6" />
                            </x-button>
                        </div>
                    </div>
                </nav>


                <!-- Page Content -->
                <main class="px-4 sm:px-6 flex-1 mx-4 mt-5 mb-24">
                    <!--Hero-->
                    <div class="pt-20">
                        <div class="flex justify-between items-center gap-20">
                            <!--Left Col-->
                            <div
                                class="flex flex-col w-full md:w-3/5 justify-center items-start text-center md:text-left">

                                <p class="uppercase tracking-loose w-full text-xl ml-2 font-semibold">Debre Berhan
                                    University</p>

                                <h1 class="mt-3 mb-5 text-5xl font-bold leading-tight">
                                    Online Examination System
                                </h1>
                                <p class="leading-normal text-base mb-10 ml-2">
                                    No more #2 pencils or sweaty palms. We've got you covered.
                                </p>
                                @if (Route::has('login'))

                                @auth

                                @else
                                <div class="flex items-cneter gap-3">
                                    <div><a href="{{ route('login') }}"
                                            class="middle none center rounded-lg ml-2 bg-cyan-500 py-2 px-6 font-sans text-lg font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            </i>Log in</a></div>
                                    <div><a href="#footer"
                                            class="font-semibold text-gray-600 rounded-md py-1 px-1 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-cyan-500  focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                                            About Us</a></div>
                                </div>
                                @endauth
                                @endif
                            </div>
                            <!--Right Col-->
                            <div class="md:w-2/6 -mr-2">
                                <img src="storage/img/landing.png" />
                            </div>
                        </div>
                    </div>

                </main>

                <!-- Mobile bottom bar -->
                <div class="fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1"
                    :class="{
                        'translate-y-full': scrollingDown,
                        'translate-y-0': scrollingUp,
                    }">
                    <a href="{{ url('/') }}">

                        <div class="inline-flex items-center gap-2">

                            <div class="w-10 ...">
                                <x-application-logo aria-hidden="true" />
                            </div>

                            <div>DBUOES</div>
                        </div>
                        <span class="sr-only">Dashboard</span>
                    </a>

                    <x-button type="button" icon-only variant="secondary" sr-text="Open main menu"
                        x-on:click="isSidebarOpen = !isSidebarOpen">
                        <x-heroicon-o-menu x-show="!isSidebarOpen" aria-hidden="true" class="w-6 h-6" />

                        <x-heroicon-o-x x-show="isSidebarOpen" aria-hidden="true" class="w-6 h-6" />
                    </x-button>
                </div>


                <!-- Page Footer -->
                <!-- ====== Footer Section Start -->
                <footer id="footer"
                    class="relative z-10 bg-slate-300 dark:bg-dark-eval-1 pt-20 pb-10 lg:pt-[64px] lg:pb-9">
                    <div class="container mx-auto">
                        <div class="flex justify-between">

                            {{-- logo and some text --}}
                            <div class="w-48">
                                <a href="" class="mb-6 inline-block max-w-[160px]">
                                    <img src="storage/img/dbu-logo.png" alt="logo" class="max-w-full w-3/5" />
                                </a>
                                <p class="text-body-color mb-7  text-sm">
                                    Debre Berhan University Online Examination System.
                                </p>
                                <p class="text-dark flex items-center text-sm font-medium">
                                    <span class="text-primary mr-3">
                                        <svg width="19" height="21" viewBox="0 0 19 21" class="fill-current">
                                            <path
                                                d="M17.8076 11.8129C17.741 11.0475 17.1088 10.5151 16.3434 10.5151H2.16795C1.40261 10.5151 0.803643 11.0808 0.703816 11.8129L0.00502514 18.8008C-0.0282506 19.2001 0.104853 19.6327 0.371059 19.9322C0.637265 20.2317 1.03657 20.398 1.46916 20.398H17.0755C17.4748 20.398 17.8741 20.2317 18.1736 19.9322C18.4398 19.6327 18.5729 19.2334 18.5396 18.8008L17.8076 11.8129ZM17.2751 19.1668C17.2419 19.2001 17.1753 19.2667 17.0422 19.2667H1.46916C1.36933 19.2667 1.2695 19.2001 1.23623 19.1668C1.20295 19.1336 1.1364 19.067 1.16968 18.9339L1.86847 11.9127C1.86847 11.7463 2.00157 11.6465 2.16795 11.6465H16.3767C16.5431 11.6465 16.6429 11.7463 16.6762 11.9127L17.375 18.9339C17.3417 19.0337 17.3084 19.1336 17.2751 19.1668Z" />
                                            <path
                                                d="M9.25704 13.1106C7.95928 13.1106 6.92773 14.1422 6.92773 15.4399C6.92773 16.7377 7.95928 17.7693 9.25704 17.7693C10.5548 17.7693 11.5863 16.7377 11.5863 15.4399C11.5863 14.1422 10.5548 13.1106 9.25704 13.1106ZM9.25704 16.6046C8.6248 16.6046 8.09239 16.0722 8.09239 15.4399C8.09239 14.8077 8.6248 14.2753 9.25704 14.2753C9.88928 14.2753 10.4217 14.8077 10.4217 15.4399C10.4217 16.0722 9.88928 16.6046 9.25704 16.6046Z" />
                                            <path
                                                d="M0.802807 6.05619C0.869358 7.52032 2.16711 8.11928 2.83263 8.11928H5.16193C5.19521 8.11928 5.19521 8.11928 5.19521 8.11928C6.19348 8.05273 7.19175 7.38722 7.19175 6.05619V5.25757C8.28985 5.25757 10.8188 5.25757 11.9169 5.25757V6.05619C11.9169 7.38722 12.9152 8.05273 13.9135 8.11928H13.9467H16.2428C16.9083 8.11928 18.206 7.52032 18.2726 6.05619C18.2726 5.95636 18.2726 5.59033 18.2726 5.25757C18.2726 4.99136 18.2726 4.75843 18.2726 4.72516C18.2726 4.69188 18.2726 4.6586 18.2726 4.6586C18.1727 3.72688 17.84 2.96154 17.2743 2.36258L17.241 2.3293C16.4091 1.56396 15.4109 1.13138 14.6455 0.865169C12.416 0 9.62088 0 9.48778 0C7.52451 0.0332757 6.26003 0.199654 4.36331 0.865169C3.63125 1.0981 2.63297 1.53068 1.80108 2.29603L1.7678 2.3293C1.20212 2.92827 0.869359 3.69361 0.769531 4.62533C0.769531 4.6586 0.769531 4.69188 0.769531 4.69188C0.769531 4.75843 0.769531 4.95809 0.769531 5.22429C0.802807 5.52377 0.802807 5.92308 0.802807 6.05619ZM2.5997 3.12792C3.26521 2.52896 4.09711 2.16292 4.7959 1.89672C6.52624 1.26448 7.65761 1.13138 9.55433 1.0981C9.68743 1.0981 12.2829 1.13138 14.2795 1.89672C14.9783 2.16292 15.8102 2.49568 16.4757 3.12792C16.8417 3.52723 17.0746 4.05964 17.1412 4.69188C17.1412 4.79171 17.1412 4.95809 17.1412 5.22429C17.1412 5.55705 17.1412 5.92308 17.1412 6.02291C17.1079 6.78825 16.3759 6.95463 16.276 6.95463H13.98C13.6472 6.92135 13.1148 6.78825 13.1148 6.05619V4.69188C13.1148 4.42567 12.9485 4.22602 12.7155 4.12619C12.5159 4.05964 6.69262 4.05964 6.49296 4.12619C6.26003 4.19274 6.09365 4.42567 6.09365 4.69188V6.05619C6.09365 6.78825 5.56124 6.92135 5.22848 6.95463H2.93246C2.83263 6.95463 2.10056 6.78825 2.06729 6.02291C2.06729 5.92308 2.06729 5.55705 2.06729 5.22429C2.06729 4.95809 2.06729 4.82498 2.06729 4.72516C2.00073 4.05964 2.23366 3.52723 2.5997 3.12792Z" />
                                        </svg>
                                    </span>
                                    <span>+012 (345) 678 99</span>
                                </p>
                            </div>
                            {{-- about us --}}
                            <div class="w-80">
                                <h3 class="text-dark mb-9 text-lg font-semibold uppercase">About Us</h3>
                                <p class="text-body-color mb-9 text-sm">
                                    Welcome to our online exam system, developed by a team of talented students from
                                    Debre Berhan University. Our goal is to provide a seamless and efficient way for
                                    students to take exams online.
                                </p>
                            </div>
                            {{-- university --}}
                            <div class="">

                                <h3 class="text-dark mb-9 text-lg font-semibold uppercase">University</h3>
                                <ul>
                                    <li>
                                        <a href="https://www.dbu.edu.et/"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            University Website
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://elearning.dbu.edu.et/"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            E-Learning
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://10.18.3.6/"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            DBU Digital Library
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://studentinfo.dbu.edu.et/"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            Student Info Portal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://journals.dbu.edu.et/index.php/birjsh"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            BIRJSH Journal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://mapcarta.com/W832511266"
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            Map & Directions
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            {{-- quick links --}}
                            <div class="">
                                <h3 class="text-dark mb-9 text-lg font-semibold uppercase">Quick Links</h3>
                                <ul>
                                    <li>
                                        <a href=""
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            Know Our Team
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            Our Services
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            News & Events
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""
                                            class="text-body-color hover:text-primary mb-2 inline-block text-sm leading-loose hover:underline">
                                            Help and support
                                        </a>
                                    </li>
                                </ul>

                            </div>

                            {{-- follow us --}}
                            <div class="">
                                <h3 class="text-dark mb-9 text-lg font-semibold uppercase">Follow Us On</h3>
                                <div class="mb-6 flex items-center gap-3">
                                    <a href="">
                                        <x-fab-facebook class="w-6 h-6  text-[#1877f2] " />
                                    </a>
                                    <a href="">
                                        <x-fab-twitter class="w-6 h-7 text-[#1da1f2] " />
                                    </a>
                                    <a href="">
                                        <x-fab-youtube class="w-6 h-6  text-[#ff0000] dark:text-red-600 " />
                                    </a>
                                    <a href="">
                                        <x-fab-linkedin class="w-6 h-6 text-[#0077b5] dark:text-blue-500 " />
                                    </a>

                                </div>
                                <p class="text-body-color text-sm">&copy; 2023 Debre Berhan <br>  University </p>


                            </div>
                        </div>
                    </div>
                </footer>


            </div>
        </div>
    </div>
    </div>
</body>

</html>
