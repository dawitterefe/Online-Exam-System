<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-user-edit class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Edit Exam Data') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-3xl mt-0 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class=" mx-9 my-7 ">
                        <div class="mx-5 mb-5 ">

                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('exams.update', $exam->id) }}" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="mx-3">
                                    <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                    <h1 class="text-base tracking-wide">{{ $exam->course->course_code }}
                                    </h1>
                                </div>


                                {{-- change name input --}}
                                <div class="space-y-2">
                                    <x-form.label for="name" :value="__('Exam Name')" />

                                    <x-form.input id="name" name="name" type="text" class="block w-full"
                                        :value="old('name', $exam->name)" required autofocus autocomplete="name" />

                                    <x-form.error :messages="$errors->get('name')" />
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
                                            placeholder="{{ __('Description') }}" name="description" :value="old('description', $exam - > description)"
                                            id="description" rows="1">
                                                    </textarea>
                                    </x-form.input-with-icon-wrapper>
                                </div>

                                {{-- Course --}}
                                <div class="space-y-2">
                                    <x-form.label for="courses" :value="__('course')" />

                                    <select id="courses" name="courses"
                                        class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                        <option selected><i class="fa fa-trash-alt"></i>Select a course
                                        </option>

                                        @foreach ($courses as $course)
                                            <option {{ $course->id == $exam->course_id ? 'selected' : '' }}
                                                value="{{ $course->id }}">{{ $course->course_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- save --}}
                                <div class="mt-5 mb-10 flex justify-end">
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
    </div>
</x-app-layout>
