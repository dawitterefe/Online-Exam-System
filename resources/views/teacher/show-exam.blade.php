<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Exam Control') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>
    <!-- component -->
    <div class="max-w-5xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">

                        <div class="mx-3 my-7 flex items-center">
                            <div class="mx-4">
                                <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                <h1 class="text-base tracking-wide">{{ $exam->course->course_title }}</h1>


                            </div>

                            <div class="mx-10 my-3">
                                <h1 class="text-base tracking-wide"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                    Starts: {{ $exam->start_time }}</h1>
                                <h1 class="text-base tracking-wide"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                    Ends: {{ $exam->start_time }}</h1>
                            </div>

                            <div class="mx-10 my-3">
                                <div flex items-center>
                                    <div>
                                        <h1 class="text-base tracking-wide">Created at:
                                            {{ date('d-m-Y', strtotime($exam->created_at)) }}</h1>
                                    </div>
                                </div>

                                <div> By
                                    @if (Auth::user()->name == \App\Models\User::find($exam->created_by)->name)
                                        You!
                                    @else
                                        Instructor {{ \App\Models\User::find($exam->created_by)->name }}
                                        {{ \App\Models\User::find($exam->created_by)->father_name }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 mb-3">
                        <div class="border border-white-700 w-full "></div>
                    </div>
                    <div class="p-3">
                        <p class="text-5xl ...">Q goes here ...</p>

                    </div>
                </div>
            </div>
        </div>
    </div>














</x-app-layout>
