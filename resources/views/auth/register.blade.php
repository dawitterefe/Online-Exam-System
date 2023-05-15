<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid gap-5">

                <div class="inline-flex items-center gap-2">
                    <!-- First Name -->
                    <div class="space-y-2">
                        <x-form.label for="first_name" :value="__('First Name')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="first_name" class="block w-full" type="text" name="first_name"
                                :value="old('first_name')" required autofocus placeholder="{{ __('First Name') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>

                    <!-- Last Name -->
                    <div class="space-y-2">
                        <x-form.label for="last_name" :value="__('Last Name')" />

                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>

                            <x-form.input withicon id="last_name" class="block w-full" type="text" name="last_name"
                                :value="old('last_name')" required autofocus placeholder="{{ __('Last Name') }}" />
                        </x-form.input-with-icon-wrapper>
                    </div>
                </div>

                {{-- gender --}}
                <div class="grid gap-0">
                    <div class="flex">

                        {{-- male --}}
                        <div class="inline-flex items-center">
                            <label class="relative flex cursor-pointer items-center rounded-full p-3" for="react"
                                data-ripple-dark="true">
                                <input value="M" name="gender" type="radio"
                                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 text-cyan-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-cyan-500 checked:before:bg-cyan-500 hover:before:opacity-10" />
                                <div
                                    class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-cyan-500 opacity-0 transition-opacity peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16"
                                        fill="currentColor">
                                        <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                                    </svg>
                                </div>
                            </label>
                            <label {{-- class="mt-px cursor-pointer select-none font-light text-gray-700" --}}
                                for="react">
                                Male
                            </label>
                        </div>

                        {{-- female --}}
                        <div class="inline-flex items-center">
                            <label class="relative flex cursor-pointer items-center rounded-full p-3" for="react"
                                data-ripple-dark="true">
                                <input value="F" name="gender" type="radio"
                                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 text-cyan-500 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-cyan-500 checked:before:bg-cyan-500 hover:before:opacity-10" />
                                <div
                                    class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-cyan-500 opacity-0 transition-opacity peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16"
                                        fill="currentColor">
                                        <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
                                    </svg>
                                </div>
                            </label>
                            <label class="mt-px cursor-pointer select-none" for="react">
                                Female
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

                                <x-form.input withicon id="email" class="block w-full" type="email" name="email"
                                    :value="old('email')" required placeholder="{{ __('Email') }}" />
                            </x-form.input-with-icon-wrapper>
                        </div>


                        <div class="flex items-center gap-2">
                            <!-- Password -->
                            <div class="space-y-2">
                                <x-form.label for="password" :value="__('Password')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="password" class="block w-full" type="password"
                                        name="password" required autocomplete="new-password"
                                        placeholder="{{ __('Password') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-form.input-with-icon-wrapper>
                                    <x-slot name="icon">
                                        <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                                    </x-slot>

                                    <x-form.input withicon id="password_confirmation" class="block w-full"
                                        type="password" name="password_confirmation" required
                                        placeholder="{{ __('Confirm Password') }}" />
                                </x-form.input-with-icon-wrapper>
                            </div>

                        </div>


                        <div>
                            <x-button class="justify-center w-full gap-2">
                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                                <span>{{ __('Register') }}</span>
                            </x-button>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Already registered?') }}
                            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
        </form>
    </x-auth-card>
</x-guest-layout>
