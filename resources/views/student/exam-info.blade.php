<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <div class="inline-flex items-center gap-2" >
                <div>
                    <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />
                </div>

                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl font-semibold leading-tight">
                        {{ __('My Exam') }}
                    </h2>
                </div>
            </div>

            <div>
                <a href="{{ URL::previous() }}"
                    class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

            </div>

        </div>

    </x-slot>
    <!-- component -->
    <div class="max-w-2xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">
                        <div class="flex justify-between items-center mt-3 ">
                            <div class="flex ml-6 mb-5 mt-3  justify-start gap-2 ... ">
                                @if ($exam->is_active)
                                <div class="flex items-center gap-2">
                                    <div>
                                        <x-bi-circle-fill class="h-4 w-4 text-green-500 dark:text-green-500" />
                                    </div>
                                    <div>ONLINE</div>
                                </div>

                                @else
                                <div class="flex items-center gap-2">
                                    <div>
                                        <x-bi-circle-fill class="h-4 w-4 text-red-500 dark:text-red-500" />

                                    </div>
                                    <div>OFFLINE</div>
                                </div>
                                @endif
                            </div>

                            <div class="flex justify-end items-center gap-2 mx-5">
                                <div><img class="flex mx-auto w-6 h-6 rounded-full"
                                        src="{{asset(\App\Models\User::find($exam->created_by)->avatar )}}" alt="">
                                </div>
                                <div>Instr. {{\App\Models\User::find($exam->created_by)->name }}
                                    {{ \App\Models\User::find($exam->created_by)->father_name }}</div>
                            </div>
                        </div>

                        <div class="mx-3 my-2 justify-start">
                            <div class="mx-4">
                                <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                <h2 class=" text-sm tracking-wide">Course - {{ $exam->course->course_title }}</h2>
                                <h2 class=" text-sm tracking-wide">{{ $exam->total_questions }} Questions</h2>
                            </div>
                            <div class="mx-4 my-3">
                                <h2 class=" text-sm tracking-wide">{{ $exam->description }}</h2>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


</x-app-layout>
