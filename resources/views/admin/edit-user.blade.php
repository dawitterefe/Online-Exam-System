<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-user-edit class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Edit User Data') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden">
                        <section>
                            <div class="flex justify-center">
                                <div class="inline-flex items-center">
                                    <div class="mr-3">
                                        <img src="{{ asset($user->avatar) }}"
                                            class="w-32 h-32 my-3 mx-auto rounded-full" alt="Avatar" />
                                    </div>

                                    <div class="mx-3">
                                        <h2 class=" font-bold text-2xl tracking-wide">{{ $user->name }}
                                            {{ $user->father_name }}</h2>
                                        <h1 class="text-base tracking-wide">{{ $user->email }}</h1>
                                    </div>

                                    <div class="mx-5 mb-5">

                                        <form method="POST" enctype="multipart/form-data"
                                            action="{{ route('users.update', $user->id) }}" class="mt-6 space-y-6">
                                            @csrf
                                            @method('PUT')
                                            <div class="inline-flex items-center gap-3 mt-3">

                                                {{-- change avatar input --}}
                                                <div>
                                                    <label class="font-regular text-gray-600 dark:text-gray-300 "
                                                        for="formFileSm">Avatar</label>
                                                </div>

                                                <div class="space-y-2">

                                                    <x-form.input id="avatar" name="avatar" type="file"
                                                        class="block w-full" optional autofocus autocomplete="avatar" />

                                                    <x-form.error :messages="$errors->get('avatar')" />
                                                </div>

                                            </div>


                                            {{-- change name input --}}
                                            <div class="space-y-2">
                                                <x-form.label for="name" :value="__('First Name')" />

                                                <x-form.input id="name" name="name" type="text" class="block w-full"
                                                    :value="old('name', $user->name)" required autofocus
                                                    autocomplete="name" />

                                                <x-form.error :messages="$errors->get('name')" />
                                            </div>

                                            {{-- change father name input --}}
                                            <div class="space-y-2">
                                                <x-form.label for="fname" :value="__('Father Name')" />

                                                <x-form.input id="fname" name="fname" type="text" class="block w-full"
                                                    :value="old('fname', $user->father_name)" required autofocus
                                                    autocomplete="name" />

                                                <x-form.error :messages="$errors->get('name')" />
                                            </div>

                                            {{-- gender --}}
                                            <div class="flex">
                                                <div class="flex items-center mr-4">
                                                    <input id="gender" type="radio" value="M" {{ $user->gender == 'M' ?
                                                    'checked' : '' }}
                                                    name="gender"
                                                    class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400
                                                    focus:ring-cyan-500 dark:focus:ring-cyan-600
                                                    dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                                                    dark:border-gray-600">
                                                    <label for=""
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male
                                                    </label>
                                                </div>

                                                <div class="flex items-center mr-4">
                                                    <input id="gender" type="radio" value="F" {{ $user->gender == 'F' ?
                                                    'checked' : '' }}
                                                    name="gender"
                                                    class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400
                                                    focus:ring-cyan-500 dark:focus:ring-cyan-600
                                                    dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700
                                                    dark:border-gray-600">
                                                    <label for=""
                                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female
                                                    </label>
                                                </div>
                                            </div>
                                            {{-- change email input --}}
                                            <div class="space-y-2">
                                                <x-form.label for="email" :value="__('Email')" />

                                                <x-form.input id="email" name="email" type="email" class="block w-full"
                                                    :value="old('email', $user->email)" required autocomplete="email" />

                                                <x-form.error :messages="$errors->get('email')" />
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
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>
