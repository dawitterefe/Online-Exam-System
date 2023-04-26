<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fluentui-book-add-24 class="w-8 h-8" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Add New Course') }}
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

                        <form method="POST" action="{{ route('courses.store') }}">
                            @csrf

                            <div class="grid gap-3">
                                <!-- course code-->
                                <div class="space-y-2">
                                    <x-form.label for="course_code" :value="__('Course Code')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            <x-tabler-id-badge-2 class="w-5 h-5" />
                                        </x-slot>

                                        <x-form.input withicon id="course_code" class="block w-full" type="text"
                                            name="course_code" :value="old('course_code')" required autofocus
                                            placeholder="{{ __('Course Code') }}" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <!-- course title-->
                                <div class="space-y-2">
                                    <x-form.label for="title" :value="__('Course Title')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            <x-tabler-id-badge-2 class="w-5 h-5" />
                                        </x-slot>

                                        <x-form.input withicon id="title" class="block w-full" type="text" name="title"
                                            :value="old('title')" required autofocus
                                            placeholder="{{ __('Course Title') }}" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <!-- credit hour -->
                                <div class="space-y-2">
                                    <x-form.label for="credit_hour" :value="__('Credit Hour')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            <x-gmdi-access-time class="w-5 h-5" />
                                        </x-slot>

                                        <x-form.input withicon id="credit_hour" class="block w-min" type="text"
                                            name="credit_hour" :value="old('credit_hour')" required autofocus
                                            placeholder="{{ __('Credit Hour') }}" />
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                {{-- add course button --}}
                                <div class="grid gap-5">
                                    <div class="flex justify-end w-13 h-9 ">
                                        <x-button class="justify-center w-half gap-2">
                                            <x-fluentui-book-add-24 class="w-6 h-6" />

                                            <span>{{ __('Add Course') }}</span>
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