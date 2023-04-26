<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-chalkboard-teacher class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Assign Course') }}
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
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <div class="mx-10 mt-7 mb-7 flex justify-center items-center gap-3">
                            <div>
                                <img src="{{ asset($teacher->user->avatar) }}" class="w-20 h-20 mx-auto rounded-full"
                                    alt="Avatar" />
                            </div>
                            <div>
                                <h2 class=" font-bold text-xl tracking-wide">{{ $teacher->user->name }}
                                    {{ $teacher->user->father_name }}</h2>
                                <h1 class="text-sm ">{{ $teacher->id }}</h1>
                                <h2 class="text-base tracking-wide">{{ $teacher->user->email }}</h2>
                            </div>
                            <div class="ml-10">
                                <div class="flex items-center">
                                    <div class="grid">
                                        <label class="my-2 font-bold"> <i class="fa-solid fa-book"></i> Assigned
                                            Courses</label>
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach ($teacher->courses as $course)
                                            <div class="w-[180px] truncate">
                                                <a
                                                    href="{{ route('admin.remove_courses', ['techer_id'=>$teacher->id, 'course_id'=>$course->id]) }}"><i
                                                        class="fa fa-times-circle"
                                                        style="color: rgb(246, 52, 52); aria-hidden=" true"></i></a>
                                                {{ $course->course_title }}
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="border-b-2 my-5 w-5/6 mx-auto"></div> --}}

                        <form method="POST" action="{{ route('admin.assign_teacher_courses', $teacher->id) }}">
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
                                                :value="old('checkbox', $course->id)" autocomplete="email" />
                                        </div>

                                        <div class="w-64 truncate">
                                            {{ $course->course_title }}
                                        </div>
                                        <x-form.error :messages="$errors->get('email')" />
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














</x-app-layout>