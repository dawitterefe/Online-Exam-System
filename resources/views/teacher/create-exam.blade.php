<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />

                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Add New Exam') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-4xl mt-0 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">

                    <div class=" mx-9 my-7 ">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('exams.store') }}">
                            @csrf

                            <div class="grid gap-5">

                                <div class="inline-flex items-center gap-3">
                                    {{-- first group? --}}
                                    <div>

                                        <!-- exam name-->
                                        <div class="space-y-2 mb-2">
                                            <x-form.label for="exam_name" :value="__('Exam Name')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    <x-tabler-id-badge-2 class="w-5 h-5" />
                                                </x-slot>

                                                <x-form.input withicon id="exam_name" class="block w-full"
                                                    type="text" name="exam_name" :value="old('exam_name')" required autofocus
                                                    placeholder="{{ __('Exam Name') }}" />
                                            </x-form.input-with-icon-wrapper>
                                        </div>
                                        <!-- exam description-->
                                        <div class="space-y-2 mb-2">
                                            <x-form.label for="description" :value="__('Description')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                                </x-slot>

                                                <textarea
                                                    class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                                    placeholder="{{ __('Description') }}" name="description" id="description" rows="1">
                                        </textarea>
                                                {{-- <x-form.input withicon id="description" class="block w-full" type="text" name="description"
                                            :value="old('description')" required autofocus
                                            placeholder="{{ __('Description') }}" /> --}}

                                            </x-form.input-with-icon-wrapper>
                                        </div>
                                        {{-- total Q and passing score --}}
                                        <div class="inline-flex items-center gap-3">
                                            <!-- total q-->
                                            <div class="space-y-2 ">
                                                <x-form.label for="total_questions" :value="__('Total Questions')" />

                                                <x-form.input-with-icon-wrapper>
                                                    <x-slot name="icon">
                                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    </x-slot>

                                                    <x-form.input withicon id="total_questions" class="block w-full"
                                                        type="text" name="total_questions" :value="old('total_questions')" required
                                                        autofocus placeholder="{{ __('Total Questions') }}" />
                                                </x-form.input-with-icon-wrapper>
                                            </div>
                                            <!-- Passing Score-->
                                            <div class="space-y-2">
                                                <x-form.label for="passing_score" :value="__('Passing Score')" />

                                                <x-form.input-with-icon-wrapper>
                                                    <x-slot name="icon">
                                                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                                    </x-slot>

                                                    <x-form.input withicon id="passing_score" class="block w-full"
                                                        type="text" name="passing_score" :value="old('passing_score')" required
                                                        autofocus placeholder="{{ __('Passing Score') }}" />
                                                </x-form.input-with-icon-wrapper>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- second group --}}
                                    <div>
                                        <!-- Course -->
                                        <div class="space-y-2 mb-2">

                                            <x-form.label for="course" :value="__('Course')" />

                                            <select id="course" name="course"
                                                class="w-full py-2  border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                                <option selected>Select the course</option>

                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->course_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- start and end --}}
                                        <div class="inline-flex items-center gap-3">
                                            <!-- start time-->
                                            <div class="space-y-2 mb-2">
                                                <x-form.label for="start_time" :value="__('Start Time')" />

                                                <x-form.input-with-icon-wrapper>
                                                    <x-slot name="icon">
                                                        <x-uni-calender-o class="w-5 h-5"/>
                                                    </x-slot>

                                                    <x-form.input withicon id="start_time" class="block w-full"
                                                        type="text" name="start_time" :value="old('start_time')" required
                                                        autofocus placeholder="{{ __('Start Time') }}" />
                                                </x-form.input-with-icon-wrapper>
                                            </div>
                                            <!-- End time-->
                                            <div class="space-y-2 mb-2">
                                                <x-form.label for="end_time" :value="__('End Time')" />

                                                <x-form.input-with-icon-wrapper>
                                                    <x-slot name="icon">
                                                        <x-uni-calender-o class="w-5 h-5"/>
                                                    </x-slot>

                                                    <x-form.input withicon id="end_time" class="block w-full"
                                                        type="text" name="end_time" :value="old('end_time')" required
                                                        autofocus placeholder="{{ __('End Time') }}" />
                                                </x-form.input-with-icon-wrapper>
                                            </div>
                                        </div>

                                        <!-- Duration -->
                                        <div class="space-y-2">
                                            <x-form.label for="duration" :value="__('Duration')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    <x-gmdi-access-time class="w-5 h-5" />
                                                </x-slot>

                                                <x-form.input withicon id="duration" class="block w-full"
                                                    type="text" name="duration" :value="old('duration')" required autofocus
                                                    placeholder="{{ __('Duration in Min') }}" />
                                            </x-form.input-with-icon-wrapper>
                                        </div>

                                    </div>



                                </div>



                                {{-- add exam button --}}
                                <div class="grid gap-5">
                                    <div class="flex justify-end w-13 h-9 ">
                                        <x-button class="justify-center w-half gap-2">
                                            <x-fluentui-book-add-24 class="w-6 h-6" />

                                            <span>{{ __('Add exam') }}</span>
                                        </x-button>
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
