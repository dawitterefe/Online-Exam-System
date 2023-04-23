<section>
    <header>
        <h2 class="text-lg font-bold text-gray-600 dark:text-gray-300">
            {{ __('Update Profile Picture ') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upadte your profile picture, Ensure its size is below two mb and it has sqaure ratio.') }}
        </p>
    </header>
    <div class="mx-5 my-3 flex justify-start text-center">
        <div class="inline-flex items-center">
            <div >
                <img src="{{ asset(Auth::user()->avatar) }}" class="w-28 rounded-full" alt="Avatar" />
            </div>

            <div class="ml-4">
                <h2 class=" font-bold text-xl tracking-wide">{{ $user->name }}
                    {{ $user->father_name }}</h2>
                <h1 class="text-base tracking-wide">{{ $user->email }}</h1>
            </div>

            <div class="ml-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}"
                    class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="inline-flex items-center gap-3 mt-3">

                        {{-- change profile input --}}
                        {{-- <div>
                            <label class="font-bold text-gray-600 dark:text-gray-300 " for="formFileSm">Update Avatar:</label>
                        </div> --}}

                        <div class="space-y-2">

                            <x-form.input id="avatar" name="avatar" type="file" class="block w-full" required
                                autofocus autocomplete="avatar" />

                            <x-form.error :messages="$errors->get('avatar')" />
                        </div>

                        {{-- save --}}
                        <div class="flex items-center gap-3">
                            <x-button>
                                {{ __('Update') }}
                            </x-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>

                    </div>


                </form>
            </div>

        </div>
    </div>

    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

</section>
