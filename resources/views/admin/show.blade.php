<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-fas-user-cog class="w-9 h-9" />

                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('User Control') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>
    <!-- component -->
    <div class="max-w-xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <div class="mx-3 my-7 justify-center text-center">
                            <div class="mx-4">
                                <img src="{{ asset($user->avatar) }}" class="w-32 h-32 my-3 mx-auto rounded-full" alt="Avatar" />

                                <h2 class=" font-bold text-2xl tracking-wide">{{ $user->name }}
                                    {{ $user->father_name }}</h2>
                                <h1 class="text-base tracking-wide">{{ $user->email }}</h1>
                                <h1 class="text-base tracking-wide">{{ $user->role->name }}</h1>
                            </div>

                            <div class="mx-10 my-3">
                                <h1 class="text-base tracking-wide">Registered at:
                                    {{ date('d-m-Y', strtotime($user->created_at)) }}</h1>
                                <h1 class="text-base tracking-wide">Last modified at:
                                    {{ date('d-m-Y', strtotime($user->updated_at)) }}</h1>
                            </div>

                            <div class="mx-15 my-4">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="middle none center rounded-lg bg-blue-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg-underline hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                    <i class="fa fa-edit"></i> Edit</a>

                                <a href=""
                                    class="middle none center rounded-lg bg-red-500  py-1 px-2 ml-1 font-sans text-xs font-bold  text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                    <i class="fa fa-trash-alt"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>














</x-app-layout>
