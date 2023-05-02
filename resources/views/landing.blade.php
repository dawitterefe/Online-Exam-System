<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" sizes="114x114" href="{{ asset('storage/img/dbu-logo.png') }}">
    {{-- <title>{{ config('app.name', 'K UI') }}</title> --}}
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
                    class="sticky top-0 z-10 flex items-center justify-between px-4 py-3 sm:px-6 transition-transform duration-500 bg-white dark:bg-dark-eval-1"
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

                                <div
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline
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

                                        @if (Route::has('register'))
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
                <main class="px-4 sm:px-6 flex-1 mx-5 my-5">

                    <div class=""> <span class="font-bold text-5xl flex justify-center mt-10"> Welcome!</span>
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
                <x-footer />
            </div>
        </div>
    </div>
    </div>
</body>

</html>
