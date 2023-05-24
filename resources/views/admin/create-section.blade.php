<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-people-roof class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Add New section') }}
                </h2>
            </div>
            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>


    <!-- component -->
    <div class="max-w-xl mt-0 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">

                    <div class=" mx-9 my-7 ">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('sections.store') }}">
                            @csrf

                            <div class="grid gap-3">
                                <!-- section name-->
                                <div class="space-y-2">
                                    <x-form.label for="name" :value="__('Section Name')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            <x-tabler-id-badge-2 class="w-5 h-5" />
                                        </x-slot>

                                        <x-form.input withicon id="name" class="block w-full" type="text"
                                            name="name" :value="old('name')" required autofocus
                                            placeholder="{{ __('section Name') }}" />
                                    </x-form.input-with-icon-wrapper>
                                </div>
                                <div class="flex items-center gap-5">
                                    <!-- Academic Year-->
                                    <div class="space-y-2">
                                        <x-form.label for="year" :value="__('Academic Year')" />

                                        <x-form.input-with-icon-wrapper>
                                            <x-slot name="icon">
                                                <x-uni-calender-o class="w-5 h-5" />
                                            </x-slot>

                                            <x-form.input withicon id="year" class="block w-full" type="text"
                                                name="year" :value="old('year')" required autofocus
                                                placeholder="{{ __('Academic Year') }}" />
                                        </x-form.input-with-icon-wrapper>
                                    </div>

                                    <!-- Semester -->
                                    <div class="space-y-2">
                                        <x-form.label for="semester" :value="__('Semester')" />
                                        <select id="semester" name="semester"
                                            class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                            <option selected><i class="fa fa-trash-alt"></i>Select a semester</option>
                                            <option value=" First">1st Semester</option>
                                            <option value="Second">2nd Semester</option>
                                            <option value="Summer">Summer</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="flex items-center gap-5 ">
                                    <!-- Degree Level -->
                                    <div class="space-y-2">
                                        <x-form.label for="degree_level" :value="__('Degree Level')" />
                                        <select id="degree_level" name="degree_level"
                                            class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                            <option selected><i class="fa fa-trash-alt"></i>Select a degree level
                                            </option>
                                            <option value="Bachelor's">Bachelor's Degree</option>
                                            <option value="Master's">Master's Degree</option>
                                            <option value="Doctoral">Doctoral Degree</option>
                                        </select>
                                    </div>
                                    <!--Program-->
                                    <div class="space-y-2">
                                        <x-form.label for="program" :value="__('Program')" />

                                        <x-form.input-with-icon-wrapper>
                                            <x-slot name="icon">
                                                <x-tabler-id-badge-2 class="w-5 h-5" />
                                            </x-slot>

                                            <x-form.input withicon id="program" class="block w-full" type="text"
                                                name="program" :value="old('program')" required autofocus
                                                placeholder="{{ __('Program') }}" />
                                        </x-form.input-with-icon-wrapper>
                                    </div>

                                </div>

                                <!-- Type-->
                                <div class="space-y-2 w-full">
                                    <x-form.label for="type" :value="__('Section Type')" />
                                    <select id="type" name="type"
                                        class=" py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                        <option selected><i class="fa fa-trash-alt"></i>Select a section type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Extension">Extension</option>
                                        <option value="Distance">Distance</option>
                                        <option value="Summer">Summer</option>

                                    </select>
                                </div>

                                {{-- add section button --}}
                                <div class="grid gap-5">
                                    <div class="flex justify-end w-13 h-9 ">
                                        <x-button class="justify-center w-half gap-2">
                                            <x-fluentui-book-add-24 class="w-6 h-6" />

                                            <span>{{ __('Add section') }}</span>
                                        </x-button>
                                    </div>
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
