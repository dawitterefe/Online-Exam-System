<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />

            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Exam Control') }}
                </h2>
            </div>

        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">

        <div class="flex mb-5 mt-0 mr-6 justify-end gap-2 ... ">
            <div>
                <a href="{{route('exams.create')}}"
                    class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add exam</a>
            </div>
            <div>
                <a href="{{route('exams.trashed')}}"
                    class="middle none center rounded-lg bg-amber-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-amber-500/20 transition-all hover:shadow-lg-underline hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    <i class="fa fa-trash-alt"></i> Trashed</a>
            </div>

        </div>

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
                                        class="py-3 pl-2 pr-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Course
                                    </th>

                                    <th scope="col"
                                        class="py-3 pl-4 pr-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Exam Starts
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Duration
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Approved By
                                    </th>


                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">Show</span>
                                    </th>
                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">Edit</span>
                                    </th>

                                    <th scope="col" class="px-6  w-1">
                                        <span class="sr-only">Delete</span>
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
                                            class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$exam->evaluations()->wherePivot('approved', true)->count()}} Evaluators</td>

                                        <td class="py-3 pr-2 pl-1 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="{{ route('exams.show', $exam->id) }}"
                                                class="middle none center rounded-lg bg-green-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg-underline hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Show</a>
                                        </td>


                                        <td class="py-3 pr-2 pl-3 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="{{ route('exams.edit', $exam->id) }}"
                                                class="middle none center rounded-lg bg-blue-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg-underline hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fa fa-edit"></i> Edit</a>
                                        </td>

                                        <td class="py-3 pr-6 pl-2 text-sm font-medium text-right whitespace-nowrap">

                                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="middle none center rounded-lg bg-red-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    data-ripple-light="true">
                                                    <i class="fa fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
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
