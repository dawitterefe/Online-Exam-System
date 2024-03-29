<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />

            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('My Exam') }}
                </h2>
            </div>
        </div>
    </x-slot>

    {{-- Notifications --}}
    <div class="mt-3 mb-1">
        @if (session('status') === 'already_taken')
        <div class="flex items-center gap-2">
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                <x-gmdi-notifications-active-o class="w-5 h-5 text-amber-600 dark:text-amber-400" />
            </div>
            <div>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-bold text-amber-600 dark:text-amber-400">
                    {{ __('You have alaready taken the exam') }}
                </p>
            </div>
        </div>
        @endif
    </div>


    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">

                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 pl-6 pr-1 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span>#</span>
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Course
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Exam Starts
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Duration
                                    </th>
                                    <th scope="col"
                                        class="py-3  text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Status
                                    </th>


                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">Show</span>
                                    </th>
                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">Edit</span>
                                    </th>


                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                @foreach ($exams as $exam)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ ($exams->currentPage() - 1) * $exams->perPage() + $loop->iteration }}
                                    </td>

                                    <td
                                        class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $exam->name }}</td>
                                    <td
                                        class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $exam->course->course_code }}</td>
                                    <td
                                        class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $exam->start_time }}</td>

                                    <td
                                        class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $exam->duration }} Min</td>
                                    <td
                                        class="py-2 pl-3 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                        @if ($exam->is_active)
                                        <x-bi-circle-fill class="h-3 w-3 text-green-500 dark:text-green-500" />
                                        @else
                                        <x-bi-circle-fill class="h-3 w-3 text-red-500 dark:text-red-500" />
                                        @endif

                                    </td>

                                    <td class="py-3 pr-2 pl-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="{{route('student.show', $exam->id)}}"
                                            class="middle none center rounded-lg bg-cyan-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> More</a>
                                    </td>

                                    <td class="py-3 pr-2 pl-3 pr-6 text-sm font-medium text-right whitespace-nowrap">

                                        @if ($exam->is_active )

                                        <a href="{{route('student.exam', $exam->id)}}"
                                            class="middle none center rounded-lg bg-green-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg-underline hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</a>

                                        @else

                                        <a href=""
                                            class="pointer-events-none middle none center rounded-lg bg-gray-400 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-gray-500/20 transition-all hover:shadow-lg-underline hover:shadow-gray-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-hourglass-start" aria-hidden="true"></i> Start</a>

                                        @endif

                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                        {{ $exams->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>
