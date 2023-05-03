<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />

                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Add New Question') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-2xl mt-0 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">

                    <div class=" mx-9 my-7 ">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('question.store') }}">
                            @csrf
                            <input type="hidden" value="{{$exam->id}}" name="exam_id" />
                            <div class="grid gap-5">
                                <!-- Question -->
                                <div class="space-y-2 ">
                                    <x-form.label for="question" :value="__('Question')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                        </x-slot>

                                        <textarea
                                            class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                            placeholder="{{ __('Question') }}" name="question" id="question" rows="2"></textarea>

                                    </x-form.input-with-icon-wrapper>
                                </div>


                                <!-- Choice One -->
                                <div class="space-y-2 ">
                                    <x-form.label for="option_1" :value="__('Choice One')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                        </x-slot>

                                        <textarea
                                            class="block w-mini py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                            placeholder="{{ __('Choice One') }}" name="option_1" id="option_1" rows="1" cols="30"></textarea>

                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <!-- Choice Two -->
                                <div class="space-y-2">
                                    <x-form.label for="option_2" :value="__('Choice Two')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                        </x-slot>

                                        <textarea
                                            class="block w-mini py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                            placeholder="{{ __('Choice Two') }}" name="option_2" id="option_2" rows="1" cols="30"></textarea>

                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <!-- Choice Three -->
                                <div class="space-y-2 ">
                                    <x-form.label for="option_3" :value="__('Choice Three')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                        </x-slot>

                                        <textarea
                                            class="block w-mini py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                            placeholder="{{ __('Choice Three') }}" name="option_3" id="option_3" rows="1" cols="30"></textarea>

                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <!-- Choice Four -->
                                <div class="space-y-2 ">
                                    <x-form.label for="option_4" :value="__('Choice Four')" />

                                    <x-form.input-with-icon-wrapper>
                                        <x-slot name="icon">
                                            {{-- <x-tabler-id-badge-2 class="w-5 h-5" /> --}}
                                        </x-slot>

                                        <textarea
                                            class="block w-mini py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                            placeholder="{{ __('Choice Four') }}" name="option_4" id="option_4" rows="1" cols="30"></textarea>

                                    </x-form.input-with-icon-wrapper>
                                </div>

                                <div class="flex items-center gap-3">

                                    <div>
                                        <!-- Correct Answer-->
                                        <div class="space-y-2 mb-2">
                                            <x-form.label for="answer" :value="__('Correct Answer')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    <x-tabler-id-badge-2 class="w-5 h-5" />
                                                </x-slot>

                                                <x-form.input withicon id="answer" class="block w-mini"
                                                    type="text" name="answer" :value="old('Correct Answer')" required autofocus
                                                    placeholder="{{ __('Correct Answer') }}" />
                                            </x-form.input-with-icon-wrapper>
                                        </div>
                                    </div>

                                    <div>
                                        <!-- Pont(s)-->
                                        <div class="space-y-2 mb-2">
                                            <x-form.label for="points" :value="__('Point(s)')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    <x-tabler-id-badge-2 class="w-5 h-5" />
                                                </x-slot>

                                                <x-form.input withicon id="points" class="block w-mini"
                                                    type="text" name="points" :value="old('Correct Answer')" required autofocus
                                                    placeholder="{{ __('Point(s)') }}" />
                                            </x-form.input-with-icon-wrapper>
                                        </div>
                                    </div>
                                </div>


                                {{-- add question button --}}
                                <div class="grid gap-5">
                                    <div class="flex justify-end w-13 h-9 ">
                                        <x-button class="justify-center w-half gap-2">
                                            <x-fluentui-book-add-24 class="w-6 h-6" />

                                            <span>{{ __('Add question') }}</span>
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
