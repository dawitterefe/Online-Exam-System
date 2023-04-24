<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fluentui-book-add-24 class="w-8 h-8" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Edit Course Data') }}
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

                        <form method="POST" action="{{ route('courses.update', $course->id) }}">
                            @csrf
                            @method('PUT')
                            {{-- change course code --}}
                            <div class="space-y-2">
                                <x-form.label for="code" :value="__('Course Code')" />

                                <x-form.input id="code" name="code" type="text" class="block w-full"
                                    :value="old('code', $course->course_code)" required autofocus autocomplete="code" />

                                <x-form.error :messages="$errors->get('code')" />
                            </div>

                            {{-- change course title --}}
                            <div class="my-3 space-y-2">
                                <x-form.label for="title" :value="__('Course Title')" />

                                <x-form.input id="title" name="title" type="text" class="block w-full"
                                    :value="old('title', $course->course_title)" required autofocus autocomplete="title" />

                                <x-form.error :messages="$errors->get('title')" />
                            </div>



                            {{-- change credit Hour --}}
                            <div class="space-y-2">
                                <x-form.label for="credit_hour" :value="__('Credit Hour')" />

                                <x-form.input id="credit_hour" name="credit_hour" type="text" class="block w-mini"
                                    :value="old('credit_hour', $course->credit_hour)" required autofocus autocomplete="credit_hour" />

                                <x-form.error :messages="$errors->get('credit_hour')" />
                            </div>
                            {{-- save --}}
                            <div class="mt-5 flex justify-end">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <x-button>
                                            {{ __('Update') }}
                                        </x-button>
                                    </div>
                                    <div>
                                        @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                                {{ __('Updated.') }}
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
