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
    <div class="max-w-4xl mt-3 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">
                        <div class="flex  mb-5 mt-3 mr-6 justify-end gap-2 ... ">
                            <div>
                                <a href="{{ route('question.create', $exam->id) }}"
                                    class="middle none center rounded-lg bg-yellow-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-yellow-500/20 transition-all hover:shadow-lg-underline hover:shadow-yellow-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Question</a>
                            </div>
                        </div>
                        <div class="mx-3 my-7 flex items-center">
                            <div class="mx-4">
                                <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                <h1 class="text-base tracking-wide">Course: {{ $exam->course->course_title }}</h1>


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
                                    @if (Auth::user()->id == \App\Models\User::find($exam->created_by)->id)
                                        You!
                                    @else
                                        Instructor {{ \App\Models\User::find($exam->created_by)->name }}
                                        {{ \App\Models\User::find($exam->created_by)->father_name }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="mx-10 my-5 ">
                        @foreach ($questions as $question)
                            <div class=" bg-slate-200 shadow sm:rounded-lg dark:bg-slate-700">
                                <div class="mx-2 my-2 p-2">
                                    <h5 class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">
                                        {{ $loop->iteration }}. {{ $question->question }} </h5>

                                    <div class="my-3 mx-12 ">
                                        {{-- choice one --}}
                                        <div class="flex items-center mr-4">
                                            <input id="1" type="radio" value="1"
                                                {{ $question->answer == 1 ? 'checked' : '' }}
                                                name="{{ $question->id }}"
                                                class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{ $question->option_1 }}
                                            </label>
                                        </div>
                                        {{-- choice two --}}
                                        <div class="flex items-center mr-4">
                                            <input id="2" type="radio" value="2"
                                                {{ $question->answer == 2 ? 'checked' : '' }}
                                                name="{{ $question->id }}" id="2"
                                                class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{ $question->option_2 }}
                                            </label>
                                        </div>

                                        @if (isset($question->option_3) && isset($question->option_4))
                                            {{-- choice three --}}
                                            <div class="flex items-center mr-4">
                                                <input id="3" type="radio" value="3"
                                                    {{ $question->answer == 3 ? 'checked' : '' }}
                                                    name="{{ $question->id }}"
                                                    class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for=""
                                                    class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{ $question->option_3 }}
                                                </label>
                                            </div>
                                            {{-- choice four --}}
                                            <div class="flex items-center mr-4">
                                                <input id="4" type="radio" value="4"
                                                    {{ $question->answer == 4 ? 'checked' : '' }}
                                                    name="{{ $question->id }}"
                                                    class="w-4 h-4 text-cyan-600 bg-gray-200 border-gray-400 focus:ring-cyan-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for=""
                                                    class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{ $question->option_4 }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mx-40 my-4 flex items-center gap-2">
                                        <div><a href="{{ route('question.edit', ['question_id' => $question->id, 'exam_id' => $exam->id]) }}"
                                                class="middle none center rounded-lg bg-blue-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg-underline hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fa fa-edit"></i> Edit</a>
                                        </div>
                                        <div>
                                            <form action="{{ route('question.destroy', $question->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="middle none center rounded-lg bg-red-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    data-ripple-light="true">
                                                    <i class="fa fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                        {{ $questions->links() }}

                    </div>


                </div>
            </div>
        </div>
    </div>

    <div
        class="my-3 inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800 grid justify-center">
        <h4 class="mb-2 mt-3 text-3xl font-medium leading-tight text-primary">
            <div class="flex items-center gap-2">
                <div>
                    <x-gmdi-rate-review-o class="h-9 w-9" />
                </div>
                <div>Reviews</div>
            </div>
        </h4>
        @foreach ($reviews as $review)
            <!-- component -->
            <div class=" text-black dark:text-gray-200 p-4 antialiased flex max-w-lg">
                <img class="rounded-full h-8 w-8 mr-2 mt-1 "
                    src="{{ asset(\App\Models\User::find(\App\Models\Evaluator::find($review->evaluator_id)->user_id)->avatar) }}" />
                <div>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                        <div class="font-semibold text-sm leading-relaxed">
                            {{ \App\Models\User::find(\App\Models\Evaluator::find($review->evaluator_id)->user_id)->name }}
                            {{ \App\Models\User::find(\App\Models\Evaluator::find($review->evaluator_id)->user_id)->father_name }}
                        </div>
                        <div class="text-normal leading-snug md:leading-normal">
                            {{ $review->review }}
                        </div>
                    </div>
                    <div class="text-sm ml-4 mt-0.5 text-gray-500 dark:text-gray-400">
                        {{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>