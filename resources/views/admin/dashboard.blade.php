<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-fileicon-dashboard class="w-8 h-8" />

            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>

        </div>
    </x-slot>
    {{-- Component --}}
    <div class="mb-4 pb-10 px-8 mx-10 rounded-xl bg-gray-200 dark:bg-slate-700 ">
        <div class="flex items-center gap-2 pt-7 ml-7">
            <div>
                <h1 class="text-xl font-bold " id="greeting"></h1>
            </div>
            <div>
                <h1 class="text-xl font-bold ">{{Auth::user()->name}}.</h1>
            </div>
        </div>
        {{-- group 1 --}}
        <div class="flex items-center gap-5 px-5 pt-10">
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                {{-- users --}}
                <a href="{{route('users.index')}}">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-heroicon-s-users class="h-9 w-9 text-fuchsia-600 dark:text-fuchsia-600 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\User::get()->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Users</div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                {{-- Courses --}}
                <a href="{{route('courses.index')}}">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-iconpark-bookshelf class="h-7.6 w-8 text-cyan-600 dark:text-cyan-400 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Course::get()->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Courses
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{-- group 2 --}}
        <div class="flex items-center gap-5 px-5 pt-3">
            {{-- Evaluators--}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                <a href="{{route('admin.evaluators')}}">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-fluentui-checkbox-person-16-o class="h-8.5 w-9 text-sky-600 dark:text-sky-500 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Evaluator::get()->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Evaluators
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            {{-- students--}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                <a href="{{route('admin.students')}}">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-fas-user-graduate class="h-7 w-7 text-yellow-500 dark:text-yellow-400 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Student::get()->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Students
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            {{-- Instructors--}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                <a href="{{route('admin.teachers')}}">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-fas-chalkboard-teacher class="h-8 w-8 text-pink-600 dark:text-pink-500 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Teacher::get()->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Instructors
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <script>
        const date = new Date();
        const hour = date.getHours();
        const greeting = document.querySelector('#greeting');

        if (hour >= 5 && hour < 12) {
        greeting.textContent = "Good morning!";
        } else if (hour >= 12 && hour < 18) {
        greeting.textContent = "Good afternoon!";
        } else {
        greeting.textContent = "Good evening!";
        }
    </script>
</x-app-layout>
