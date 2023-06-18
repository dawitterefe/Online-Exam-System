<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-majestic-checkbox-list-detail-solid class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Exam') }}
                </h2>
            </div>

            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-4xl mt-3 mb-10 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="overflow-hidden ">
                        <div class="flex justify-between items-center mt-3 mx-10">
                            <div class="mx-4">
                                <h2 class=" font-bold text-2xl tracking-wide">{{ $exam->name }}</h2>
                                <h1 class="text-base tracking-wide">Course - {{ $exam->course->course_title }}</h1>
                            </div>
                            <div id="deadline"
                                class="flex justify-end items-center text-gray-900 dark:text-amber-300 gap-2 mx-5">

                            </div>
                        </div>
                    </div>

                    <div class="mx-10 my-5 ">
                        <form action="{{route('student.submit-exam',$exam->id)}}" method="POST">
                            @csrf
                            @foreach ($questions as $question)
                            <div class=" bg-slate-200 shadow sm:rounded-lg dark:bg-slate-700">
                                <div class="mx-2 my-2 p-2">
                                    <h5 class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">
                                        {{$loop->iteration}}. {{$question->question}} </h5>

                                    <div class="my-3 mx-12 ">
                                        {{-- choice one --}}
                                        <div class="flex items-center mr-4">
                                            <input id="{{ $question->id}}" name="{{$question->id}}" type="radio"
                                                value="1" class="w-4 h-4 text-cyan-600 bg-gray-300 border-gray-600 focus:ring-cyan-500
                                        dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-600
                                        dark:border-gray-400">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{
                                                $question->option_1 }}
                                            </label>
                                        </div>
                                        {{-- choice two --}}
                                        <div class="flex items-center mr-4">
                                            <input id="{{$question->id}}" name="{{$question->id}}" type="radio"
                                                value="2" id="2" class="w-4 h-4 text-cyan-600 bg-gray-300 border-gray-600 focus:ring-cyan-500
                                        dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-600
                                        dark:border-gray-400">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{
                                                $question->option_2 }}
                                            </label>
                                        </div>
                                        @if (isset($question->option_3) && isset($question->option_4))
                                        {{-- choice three --}}
                                        <div class="flex items-center mr-4">
                                            <input id="{{$question->id}}" name="{{$question->id}}" type="radio"
                                                value="3" class="w-4 h-4 text-cyan-600 bg-gray-300 border-gray-600 focus:ring-cyan-500
                                        dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-600
                                        dark:border-gray-400">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">{{
                                                $question->option_3 }}
                                            </label>
                                        </div>
                                        {{-- choice four --}}
                                        <div class="flex items-center mr-4">
                                            <input id="{{$question->id}}" name="{{$question->id}}" type="radio"
                                                value="4" class="w-4 h-4 text-cyan-600 bg-gray-300 border-gray-600 focus:ring-cyan-500
                                            dark:focus:ring-cyan-600 dark:ring-offset-gray-800 focus:ring-2
                                            dark:bg-gray-600 dark:border-gray-400">
                                            <label for=""
                                                class="ml-2 text-base font-medium text-gray-900 dark:text-gray-100">
                                                {{$question->option_4}}
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="flex justify-between items-center">
                                <div class="flex justify-start items-center gap-2 mx-5">
                                    <div><img class="flex mx-auto w-6 h-6 rounded-full"
                                            src="{{asset(\App\Models\User::find($exam->created_by)->avatar )}}" alt="">
                                    </div>
                                    <div>Instr. {{\App\Models\User::find($exam->created_by)->name }}
                                        {{ \App\Models\User::find($exam->created_by)->father_name }}</div>
                                </div>

                                <div class="flex justify-end w-13 mx-5 h-9 mt-3 ">
                                    <x-button id="submit-exam" class="justify-center w-half gap-2">
                                        <x-fas-hourglass-end class="w-4 h-4" />
                                        <span>{{ __('Finish Exam') }}</span>
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @csrf


    <script>
        var duration = {{$duration}} * 60;
        var time = duration;
        var deadline = document.getElementById('deadline');
        var exam_id = {{$exam->id}};

        setInterval(function(){

            var counter = time--, min = (counter/60)>>0, sec=(counter-min*60) + '';

            deadline.textContent = 'Time remaining: ' + min + 'm : ' + (sec.length>1?'':'0') + sec + "s ";

            //sumbit exam automatically
            if(counter == 0){
                document.getElementById('submit-exam').click();
            }


             function sendDuration(remaining_time) {

                var xhttp = new XMLHttpRequest();

                var url = '/send-remaining-time/'+remaining_time+"/exam-id/"+exam_id;

                xhttp.open("GET",url,true);
                xhttp.send();
             }

             //call the sendDuration fuction
             var remaining_time = counter/60;
             sendDuration(remaining_time);

        },1000);

        document.addEventListener("visibilitychange", function() {
        if (document.hidden) {
            // Page is hidden, log out the user
            window.location = "/logout";
        }
        });


    </script>



</x-app-layout>
