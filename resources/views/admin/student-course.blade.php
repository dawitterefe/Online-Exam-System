<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-user-graduate class="w-9 h-9" />

                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Student Courses') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>
    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="mx-10 mt-7 mb-7 flex justify-center items-center gap-3">
                <div>
                    <img src="{{ asset($student->user->avatar) }}" class="w-20 h-20 mx-auto rounded-full"
                        alt="Avatar" />
                </div>
                <div>
                    <h2 class=" font-bold text-xl tracking-wide">{{ $student->user->name }}
                        {{ $student->user->father_name }}</h2>
                    <h1 class="text-sm ">{{ $student->id }}</h1>
                    <h2 class="text-base tracking-wide">{{ $student->user->email }}</h2>
                </div>
            </div>
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span>#</span>
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Course Code
                                    </th>
                                    <th scope="col"
                                        class="py-3 pl-7 pr-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-0 pr-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Credit Hour
                                    </th>
                                    <th scope="col"
                                        class="py-3 pr-6 pl-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Reg. Date
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

                                @foreach ($student->courses as $course)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-5 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$loop->iteration }}
                                    </td>
                                    <td
                                        class="py-5 px-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $course->course_code }}</td>
                                    <td
                                        class="w-[200px] truncate py-5 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="w-40 truncate">
                                            {{ $course->course_title }}
                                        </div>
                                    </td>

                                    <td
                                        class="py-5 px-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $course->credit_hour }}</td>
                                    <td
                                        class="py-5 pr-6 pl-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ date('d-m-Y', strtotime($course->created_at)) }}</td>

                                    <td class="py-5 pl-1 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="{{ route('courses.show', $course->id) }}"
                                            class="middle none center rounded-lg bg-green-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg-underline hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-eye" aria-hidden="true"></i> Show</a>
                                    </td>


                                    <td class="py-5 pr-2 pl-3 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="{{ route('courses.edit', $course->id) }}"
                                            class="middle none center rounded-lg bg-blue-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg-underline hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-edit"></i> Edit</a>
                                    </td>

                                    <td class="py-5 pr-6 pl-2 text-sm font-medium text-right whitespace-nowrap">
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>














</x-app-layout>
