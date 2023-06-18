<section>
    <header>
        <div class="flex items-center gap-3">
            <div>
                <h2 class="text-lg font-bold text-gray-600 dark:text-gray-300">
                    {{ __('Update Password') }}
                </h2>
            </div>
            <div>
                @if (session('status') === 'password-updated')
                <div class="flex items-center gap-2">
                    <div x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 3000)">
                        <x-gmdi-notifications-active-o class="w-5 h-5 text-green-600 dark:text-green-400" />
                    </div>
                    <div>
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="text-sm font-bold text-green-600 dark:text-green-400">
                            {{ __('Your Password was changed successfully!') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>



        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>


    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="inline-flex items-center gap-5">
            <div class="space-y-2">
                <x-form.label for="current_password" :value="__('Current Password')" />

                <x-form.input id="current_password" name="current_password" type="password" class="block w-full"
                    autocomplete="current-password" />

                <x-form.error :messages="$errors->updatePassword->get('current_password')" />

            </div>
            <div class="space-y-2">
                <x-form.label for="password" :value="__('New Password')" />

                <x-form.input id="password" name="password" type="password" class="block w-full"
                    autocomplete="new-password" />

                <x-form.error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="space-y-2">
                <x-form.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-form.input id="password_confirmation" name="password_confirmation" type="password"
                    class="block w-full" autocomplete="new-password" />

                <x-form.error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

        </div>



        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Change Password') }}
            </x-button>
        </div>
    </form>
</section>
