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
        <div class="flex items-center gap-5 px-5 pt-10">
            {{-- Courses --}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">

                <a href="#courses">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-iconpark-bookshelf class="h-9 w-8 text-fuchsia-500 dark:text-fuchsia-500 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{auth()->user()->student->courses->count()}}</div>
                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Courses</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Total Exams --}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">

                <a href="#courses">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-majestic-paper-fold-text-line class="h-9 w-9 text-sky-600 dark:text-sky-500 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{
                                    \App\Models\Exam::whereIn('course_id',(auth()->user()->student->courses)->pluck('id'))->count()}}
                                </div>
                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Total Exams
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- upcoming exams--}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                <a href="#courses">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-uni-calender-o class="h-8 w-8 text-yellow-600 dark:text-yellow-500 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Exam::whereIn('course_id',
                                    auth()->user()->student->courses->pluck('id'))
                                    ->whereDoesntHave('results', function ($query) {
                                    return $query->where('student_id', auth()->user()->student->id);
                                    })
                                    ->where('is_active', false)
                                    ->count()}}</div>

                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Upcoming Exams
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- Completed exams--}}
            <div
                class="w-full transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white dark:bg-slate-800">
                <a href="#courses">
                    <div class="p-5">
                        <div class="flex justify-end">
                            <x-fas-check-square class="h-7 w-7 text-green-500 dark:text-green-400 " />
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div class="mt-2 text-3xl font-bold leading-8 ">
                                    {{\App\Models\Exam::whereIn('course_id',
                                    auth()->user()->student->courses->pluck('id'))
                                    ->whereHas('results', function ($query) {
                                    return $query->where('student_id', auth()->user()->student->id);
                                    })
                                    ->where('is_active', false)
                                    ->count()}}
                                </div>
                                <div class="mt-1 text-base text-gray-600 dark:text-gray-500">Completed Exams
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{-- tables --}}
        <div class="flex  gap-5">
            {{-- Your Courses --}}
            <div class="pl-5 pt-10 w-min">
                <div id="courses"
                    class="flex justify-start items-center gap-2 mb-3 text-3xl font-medium leading-tight text-primary">

                    <div>
                        <x-iconpark-bookshelf class="h-9 w-8 text-fuchsia-500 dark:text-fuchsia-500 " />

                    </div>
                    <div class="text-xl">Your Courses</div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700  rounded-lg">
                    <thead class="bg-gray-400 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-3 px-6 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400  rounded-tl-lg  rounded-bl-lg">
                                <span>#</span>
                            </th>
                            <th scope="col"
                                class="py-3 px-6 text-xs tracking-wider text-left text-gray-100  uppercase dark:text-gray-400">
                                Course.C
                            </th>
                            <th scope="col"
                                class="py-3 pl-7 pr-3 text-xs  tracking-wider text-left text-gray-100  uppercase dark:text-gray-400">
                                Title
                            </th>
                            <th scope="col"
                                class="py-3 px-2 text-xs  tracking-wider text-left text-gray-100  uppercase dark:text-gray-400 rounded-tr-lg  rounded-br-lg">
                                Credit...
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach (auth()->user()->student->courses as $course)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td
                                class="py-2 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white  rounded-tl-lg rounded-bl-lg">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-2 px-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                {{ $course->course_code }}</td>
                            <td class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white ">
                                <div class="w-30 truncate">
                                    {{ $course->course_title }}
                                </div>
                            </td>

                            <td
                                class="py-2 px-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white rounded-tr-lg rounded-br-lg">
                                {{ $course->credit_hour }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Your exams --}}
            <div class="pr-5 pt-10 w-full">
                <div id="courses"
                    class="flex justify-start items-center gap-2 mb-3 text-3xl font-medium leading-tight text-primary">

                    <div>
                        <x-majestic-paper-fold-text-line class="h-9 w-9 text-sky-600 dark:text-sky-500 " />
                    </div>
                    <div class="text-xl">Your Exams</div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700  rounded-lg">
                    <thead class="bg-gray-400 dark:bg-gray-800">

                        <tr>
                            <th scope="col"
                                class="py-3 pl-6 pr-1 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tl-lg  rounded-bl-lg">
                                <span>#</span>
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Name
                            </th>

                            <th scope="col"
                                class="py-3 pl-2 pr-1 text-xs  tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Course
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tr-lg  rounded-br-lg">
                                <div class="w-30 truncate">Instructor </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach (\App\Models\Exam::whereIn('course_id',
                        (auth()->user()->student->courses->pluck('id')))->get() as $exam)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td
                                class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tl-lg  rounded-bl-lg">
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class=" py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="w-30 truncate"> {{ $exam->name }} </div>
                            </td>
                            <td class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                {{ $exam->course->course_code }}</td>

                            <td
                                class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tr-lg  rounded-br-lg">
                                <div class="flex items-center gap-2">
                                    <div><img src="{{asset(\App\Models\User::findOrFail($exam->created_by)->avatar)}}"
                                            class="h-5 w-5 rounded-full" alt=""></div>
                                    <div>{{\App\Models\User::findOrFail($exam->created_by)->name}}
                                        {{\App\Models\User::findOrFail($exam->created_by)->father_name}}</div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        {{-- Below --}}
        <div class="flex  gap-1">
            {{-- completed Exams --}}
            <div class="px-5 pt-6 w-full">
                <div id="courses"
                    class="flex justify-start items-center gap-2 mb-3 text-3xl font-medium leading-tight text-primary">

                    <div>
                        <x-fas-check-square class="h-7 w-7 text-green-500 dark:text-green-400 " />
                    </div>
                    <div class="text-xl">Completed Exams</div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700  rounded-lg">
                    <thead class="bg-gray-400 dark:bg-gray-800">

                        <tr>
                            <th scope="col"
                                class="py-3 pl-6 pr-1 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tl-lg  rounded-bl-lg">
                                <span>#</span>
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Name
                            </th>

                            <th scope="col"
                                class="py-3 pl-2 pr-1 text-xs  tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Course
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tr-lg  rounded-br-lg">
                                <div class="w-30 truncate">Instructor </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach (\App\Models\Exam::whereIn('course_id', auth()->user()->student->courses->pluck('id'))
                        ->whereHas('results', function ($query) {
                        return $query->where('student_id', auth()->user()->student->id);
                        })
                        ->where('is_active', false)
                        ->get() as $exam)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td
                                class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tl-lg  rounded-bl-lg">
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class=" py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="w-30 truncate"> {{$exam->name }} </div>
                            </td>
                            <td class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                {{$exam->course->course_code}}</td>

                            <td
                                class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tr-lg  rounded-br-lg">
                                <div class="flex items-center gap-2">
                                    <div><img src="{{asset(\App\Models\User::findOrFail($exam->created_by)->avatar)}}"
                                            class="h-5 w-5 rounded-full" alt=""></div>
                                    <div>{{\App\Models\User::findOrFail($exam->created_by)->name}}
                                        {{\App\Models\User::findOrFail($exam->created_by)->father_name}}</div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Upcoming Exams --}}
            <div class="px-5 pt-6 w-full">
                <div id="courses"
                    class="flex justify-start items-center gap-2 mb-3 text-3xl font-medium leading-tight text-primary">

                    <div>
                        <x-uni-calender-o class="h-7 w-7 text-yellow-600 dark:text-yellow-500 " />
                    </div>
                    <div class="text-xl">Upcoming Exams</div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700  rounded-lg">
                    <thead class="bg-gray-400 dark:bg-gray-800">

                        <tr>
                            <th scope="col"
                                class="py-3 pl-6 pr-1 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tl-lg  rounded-bl-lg">
                                <span>#</span>
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Name
                            </th>

                            <th scope="col"
                                class="py-3 pl-2 pr-1 text-xs  tracking-wider text-left text-white uppercase dark:text-gray-400">
                                Course
                            </th>

                            <th scope="col"
                                class="py-3 px-3 text-xs font-large tracking-wider text-left text-white uppercase dark:text-gray-400 rounded-tr-lg  rounded-br-lg">
                                <div class="w-30 truncate">Instructor </div>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach (\App\Models\Exam::whereIn('course_id', auth()->user()->student->courses->pluck('id'))
                        ->whereDoesntHave('results', function ($query) {
                        return $query->where('student_id', auth()->user()->student->id);
                        })
                        ->where('is_active', false)
                        ->get() as $exam)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td
                                class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tl-lg  rounded-bl-lg">
                                {{ $loop->iteration }}
                            </td>
                            <td
                                class=" py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="w-30 truncate"> {{$exam->name }} </div>
                            </td>
                            <td class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                {{$exam->course->course_code}}</td>

                            <td
                                class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white rounded-tr-lg  rounded-br-lg">
                                <div class="flex items-center gap-2">
                                    <div><img src="{{asset(\App\Models\User::findOrFail($exam->created_by)->avatar)}}"
                                            class="h-5 w-5 rounded-full" alt=""></div>
                                    <div>{{\App\Models\User::findOrFail($exam->created_by)->name}}
                                        {{\App\Models\User::findOrFail($exam->created_by)->father_name}}</div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
