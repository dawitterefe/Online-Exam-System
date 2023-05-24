<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-fas-user-graduate class="w-9 h-9" />
            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Student Control') }}
                </h2>
            </div>

        </div>

    </x-slot>


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
                                        <span class="sr-only">Avatar</span>
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-0 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-0 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Id
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-1 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Gender
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Email
                                    </th>

                                    <th scope="col"
                                        class="py-3 px-3 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Reg. Date
                                    </th>


                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">Show</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                @foreach ($students as $student)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                                    </td>

                                    <td
                                        class="py-2 pl-6 pl-3 pr-0 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        <img src="{{ asset($student->user->avatar) }}"
                                            class="w-7 h-7 my-3 mx-auto rounded-full" alt="Avatar" />
                                    </td>
                                    <td
                                        class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $student->user->name }} {{ $student->user->father_name }}</td>
                                    <td
                                        class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $student->id }}</td>
                                    <td
                                        class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $student->user->gender }}</td>
                                    <td
                                        class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $student->user->email }}</td>

                                    <td
                                        class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ date('d-m-Y', strtotime($student->created_at)) }}</td>

                                    <td class="py-2 pr-7 pl-0 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="{{route('admin.show_student_courses',$student->id)}}"
                                            class="middle none center rounded-lg bg-cyan-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa-solid fa-book"></i> Courses</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                        {{ $students->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>
