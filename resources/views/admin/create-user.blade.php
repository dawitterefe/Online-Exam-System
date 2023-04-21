<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-typ-user-add class="w-11 h-11" />

                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Add New User') }}
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

                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="grid gap-5">

                                <div class="inline-flex items-center gap-3">
                                    <!-- First Name -->
                                    <div class="space-y-2">
                                        <x-form.label for="first_name" :value="__('First Name')" />

                                        <x-form.input-with-icon-wrapper>
                                            <x-slot name="icon">
                                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                            </x-slot>

                                            <x-form.input withicon id="first_name" class="block w-full" type="text"
                                                name="first_name" :value="old('first_name')" required autofocus
                                                placeholder="{{ __('First Name') }}" />
                                        </x-form.input-with-icon-wrapper>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="space-y-2">
                                        <x-form.label for="last_name" :value="__('Last Name')" />

                                        <x-form.input-with-icon-wrapper>
                                            <x-slot name="icon">
                                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                            </x-slot>

                                            <x-form.input withicon id="last_name" class="block w-full" type="text"
                                                name="last_name" :value="old('last_name')" required autofocus
                                                placeholder="{{ __('Last Name') }}" />
                                        </x-form.input-with-icon-wrapper>
                                    </div>
                                </div>

                                {{-- gender --}}
                                <div class="grid gap-3">
                                    <div class="flex">
                                        <div class="flex items-center mr-4">
                                            <input id="gender" type="radio" value="M"
                                                name="gender"
                                                class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for=""
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male
                                            </label>
                                        </div>

                                        <div class="flex items-center mr-4">
                                            <input id="gender" type="radio" value="F"
                                                name="gender"
                                                class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for=""
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female
                                            </label>
                                        </div>
                                    </div>

                                    <div class="grid gap-5">
                                        <!-- Email Address -->
                                        <div class="space-y-2">
                                            <x-form.label for="email" :value="__('Email')" />

                                            <x-form.input-with-icon-wrapper>
                                                <x-slot name="icon">
                                                    <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                                                </x-slot>

                                                <x-form.input withicon id="email" class="block w-full"
                                                    type="email" name="email" :value="old('email')" required
                                                    placeholder="{{ __('Email') }}" />
                                            </x-form.input-with-icon-wrapper>
                                        </div>


                                        <!-- Role -->
                                        <div class="space-y-2">

                                            <x-form.label for="roles" :value="__('Role')" />

                                            <select id="roles" name="roles"
                                                class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">

                                                <option selected><i class="fa fa-trash-alt"></i>Select a role</option>

                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>





                                        <div class="flex justify-end w-13 h-9 ">
                                            <x-button class="justify-center w-half gap-2">
                                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                                                <span>{{ __('Add User') }}</span>
                                            </x-button>
                                        </div>
                                    </div>
                        </form>





                    </div>
                </div>
            </div>
        </div>
    </div>




















</x-app-layout>
