<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-fas-people-roof class="w-9 h-9" />
            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Section Control') }}
                </h2>
            </div>

        </div>

    </x-slot>
    <div class="pt-1 pb-3 pl-5">
        <div class="flex justify-start items-center gap-2 text-2xl font-medium leading-tight text-primary">
            <div>
                <x-iconpark-bookshelf class="w-7 h-7" />
            </div>
            <div> Control Section Courses </div>
        </div>
    </div>

    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <div class="mx-10 mt-7 mb-7 flex justify-center items-center gap-3">
                            <div class="p-5">
                                <h2 class=" font-bold text-2xl tracking-wide"> {{$section->name }}</h2>
                            </div>

                            <div class="ml-10">
                                <div class="flex items-center">
                                    <div class="grid">
                                        <label class="my-2 font-bold"> <i class="fa-solid fa-book"></i> Assigned
                                            Courses</label>
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach ($section->courses as $course)
                                            <div class="w-[180px] truncate">
                                                <a
                                                    href="{{ route('admin.detach_section_courses', ['section_id'=>$section->id, 'course_id'=>$course->id]) }}"><i
                                                        class="fa fa-times-circle"
                                                        style="color: rgb(246, 52, 52); aria-hidden = true"></i></a>
                                                {{ $course->course_title }}
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-5">
                            <form method="POST" action="{{ route('admin.assign_section_courses', $section->id) }}">
                                @csrf
                                @method('HEAD')
                                {{-- course checkbox --}}
                                <div class="flex justify-center">
                                    <div class="grid grid-cols-3">
                                        @foreach ($courses as $course)
                                        <div class="flex items-center gap-2 my-2">

                                            <div>
                                                <x-form.input
                                                    class=" w-1 h-1 before:content[''] peer relative  cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:bg-pink-500 checked:before:bg-pink-500 dark:checked:border-pink-500 dark:checked:bg-pink-500 dark:checked:before:bg-pink-500 hover:before:opacity-10"
                                                    id="courses[]" name="courses[]" type="checkbox"
                                                    :value="old('checkbox', $course->id)" autocomplete="courses[]" />
                                            </div>

                                            <div class="w-64 truncate">
                                                {{ $course->course_title }}
                                            </div>
                                            <x-form.error :messages="$errors->get('courses[]')" />
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- save --}}
                                <div class="mt-5 mb-10 mr-10 flex justify-end">
                                    <div class="flex items-center gap-2">
                                        <div>
                                            <x-button>
                                                {{ __('Assign Course(s)') }}
                                            </x-button>
                                        </div>
                                        <div>
                                            @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                                {{ __('Done.') }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-10 pb-3 pl-5">
        <div class="flex justify-start items-center gap-2 text-2xl font-medium leading-tight text-primary">
            <div>
                <x-fas-user-graduate class="w-7 h-7" />
            </div>
            <div>Students in This Section</div>
        </div>
    </div>


    @if ($students->first() != null)
    <!-- component 2 -->
    <div class="max-w-5xl mt-5 mx-auto">
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
                                    <th scope="col"
                                        class="py-3 pl-3 pr-6 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span class="sr-only">Delete</span>
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
                                    <td
                                        class="py-2 pl-3 pr-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a class="middle none center rounded-lg bg-red-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            href="{{ route('admin.remove_student_section',['id'=>$student->id,'section_id'=>$section->id ])}}">
                                            <i class="fa fa-trash-alt"></i> Delete</i></a>
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
    @else <div class="flex justify-center items-center gap-2 text-xl leading-tight text-primary">There are no students
        added in this section...</div>
    @endif


    <div class="pt-10 pb-3 pl-5">
        <div class="flex justify-start items-center gap-2 text-2xl font-medium leading-tight text-primary">
            <div>
                <x-fas-user-graduate class="w-7 h-7" />
            </div>
            <div> Add Students </div>
        </div>
    </div>
    @if ($students_without_section->first() != null)
    <!-- component 3 -->
    <div class="max-w-5xl mt-5 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
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
                                    <th scope="col"
                                        class="py-3 pl-3 pr-4 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span class="sr-only">Checkbox</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <form method="POST" action="{{ route('admin.add_students', $section->id) }}">
                                    @csrf
                                    @method('HEAD')
                                    @foreach ($students_without_section as $student_without_section)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td
                                            class="py-2 pl-6 pr-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{($students_without_section->currentPage()-1)*$students_without_section->perPage()+$loop->iteration}}
                                        </td>

                                        <td
                                            class="py-2 pl-6 pl-3 pr-0 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                            <img src="{{ asset($student_without_section->user->avatar) }}"
                                                class="w-7 h-7 my-3 mx-auto rounded-full" alt="Avatar" />
                                        </td>
                                        <td
                                            class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $student_without_section->user->name }} {{
                                            $student_without_section->user->father_name }}</td>
                                        <td
                                            class="py-2 pr-3 pl-0 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $student_without_section->id }}</td>
                                        <td
                                            class="py-2 px-1 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                            {{ $student_without_section->user->gender }}</td>
                                        <td
                                            class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $student_without_section->user->email }}</td>

                                        <td
                                            class="py-2 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ date('d-m-Y', strtotime($student_without_section->created_at)) }}</td>
                                        <td
                                            class="py-2 pl-3 pr-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center gap-2 my-2">

                                                <div>
                                                    <x-form.input
                                                        class=" w-1 h-1 before:content[''] peer relative  cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-pink-500 checked:bg-pink-500 checked:before:bg-pink-500 dark:checked:border-pink-500 dark:checked:bg-pink-500 dark:checked:before:bg-pink-500 hover:before:opacity-10"
                                                        id="students_without_section[]"
                                                        name="students_without_section[]" type="checkbox"
                                                        value="{{$student_without_section->id}}"
                                                        autocomplete="students_without_section[]" />
                                                </div>
                                                <x-form.error :messages="$errors->get('students_without_section[]')" />
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- save --}}
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div class="my-3 mr-10 flex justify-end">
                                            <div class="flex items-center gap-2">
                                                <div>
                                                    <x-button>
                                                        {{ __('Add User(s)') }}
                                                    </x-button>
                                                </div>
                                                <div>
                                                    @if (session('status') === 'profile-updated')
                                                    <p x-data="{ show: true }" x-show="show" x-transition
                                                        x-init="setTimeout(() => show = false, 2000)"
                                                        class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                                        {{ __('Done.') }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            </tfoot>
                            </form>
                            </tbody>
                        </table>
                        <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                            {{ $students_without_section->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else <div class="flex justify-center items-center gap-2 text-xl leading-tight text-primary">There are no students
        without section...</div>
    @endif




</x-app-layout>
