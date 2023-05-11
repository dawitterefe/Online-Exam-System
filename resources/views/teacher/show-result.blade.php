<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-award class="w-8 h-8" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Exam Results') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>
    <!-- component -->
    <div class="max-w-4xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <div class="mx-3 my-7 flex items-center">
                            <div class="mx-4">
                                <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                <h1 class="text-base tracking-wide">Course: {{ $exam->course->course_title }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="mx-10 my-3 ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 pl-6 pr-1 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span>#</span>
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span class="sr-only">Avatar</span>
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-0 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="py-3 pr-3 text-xs tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Gender
                                    </th>

                                    <th scope="col"
                                        class="py-3 pl-10 pr-3 text-xs tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Id
                                    </th>

                                    <th scope="col"
                                        class="py-3 pr-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Score
                                    </th>

                                    <th scope="col"
                                        class="py-3 pl-4 pr-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span class="sr-only">passed</span>
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                @foreach ($results as $result)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ ($results->currentPage() - 1) * $results->perPage() +
                                        $loop->iteration }}
                                    </td>
                                    <td
                                        class="py-1 pl-6 pl-3 pr-0 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        <img src="{{asset((\App\Models\User::findOrFail(\App\Models\Student::findOrFail($result->student_id)->user_id))->avatar)}}"
                                            class="w-6 h-6 my-3 mx-auto rounded-full" alt="Avatar" />
                                    </td>
                                    <td
                                        class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{\App\Models\User::findOrFail(\App\Models\Student::findOrFail($result->student_id)->user_id)->name
                                        }}
                                        {{\App\Models\User::findOrFail(\App\Models\Student::findOrFail($result->student_id)->user_id)->father_name}}
                                    </td>
                                    <td
                                        class="py-2 pl-5 pr-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{\App\Models\User::findOrFail(\App\Models\Student::findOrFail($result->student_id)->user_id)->gender
                                        }}</td>
                                    <td
                                        class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{$result->student_id}}</td>
                                    <td
                                        class="py-2 pl-4 pr-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $result->score }}</td>
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
            </div>
        </div>
    </div>
</x-app-layout>
