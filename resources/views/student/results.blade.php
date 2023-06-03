<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-fas-award class="w-8 h-8" />
            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('My Result') }}
                </h2>
            </div>
        </div>
    </x-slot>

    {{-- Notifications --}}
    <div class="mt-3 mb-1">
        @if (session('status') === 'passed')
        <div class="flex items-center gap-2">
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)">
                <x-fas-smile class="w-5 h-5 text-yellow-600 dark:text-yellow-400" />
            </div>
            <div>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm font-bold text-green-600 dark:text-green-400">
                    {{ __('Congratulations! You passed the exam.') }}
                </p>
            </div>
        </div>
        @endif
    </div>

    <div class="mt-3 mb-1">
        @if (session('status') === 'failed')
        <div class="flex items-center gap-2">
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)">
                <x-fas-face-sad-tear class="w-5 h-5 text-red-600 dark:text-red-400" />
            </div>
            <div>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm font-bold text-red-600 dark:text-red-400">
                    {{ __('You failed this exam. Looks like you need to study more.') }}
                </p>
            </div>
        </div>
        @endif
    </div>

    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">


        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                @if ($results->isEmpty())
                <div class="flex justify-center my-3">
                    <div class="flex items-center gap-3">
                        <div>
                            <x-fluentui-emoji-sad-slight-24 class="h-7 w-7 text-yellow-500" />
                        </div>

                        <div>
                            <h2 class="font-semibold">You have not submitted or finished any exams yet.</h2>
                        </div>
                    </div>
                </div>
                @else
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
                                        Exam Name
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Course Title
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Credit Hour
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Questions
                                    </th>


                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Score
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span class="sr-only">passed</span>

                                    </th>

                                </tr>
                            </thead>


                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                @foreach ($results as $result)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{($results->currentPage() - 1) * $results->perPage() + $loop->iteration }}
                                    </td>
                                    <td
                                        class=" w-[180px] truncate py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$result->exam->name}}</td>

                                    <td
                                        class="w-[180px] truncate py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{$result->exam->course->course_title}}</td>
                                    <td
                                        class=" py-2 pl-8 pr-1  text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{$result->exam->course->credit_hour}}</td>
                                    <td
                                        class=" py-2 pl-7 pr-1  text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{$result->exam->total_questions}}</td>
                                    <td
                                        class="py-2 pl-6 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$result->score}}</td>

                                    <td
                                        class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($result->passed)
                                        <div class="flex items-center gap-1">
                                            <div>
                                                <x-codicon-pass class="h-5 w-5 text-green-700 dark:text-green-500" />

                                            </div>
                                            <div class="h-5 w-5 text-green-700 dark:text-green-500">passed</div>
                                        </div>
                                        @else
                                        <div class="flex items-center gap-1">
                                            <div>
                                                <x-heroicon-o-exclamation-circle
                                                    class="h-5 w-5 text-red-700 dark:text-red-500" />
                                            </div>
                                            <div class="h-5 w-5 text-red-700 dark:text-red-500">failed</div>
                                        </div>

                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                        {{ $results->links() }}

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>





</x-app-layout>
