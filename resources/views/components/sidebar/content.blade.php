<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    {{-- ADMIN ONLY SIDEBAR LINKS --}}
    @if (Auth::user()->role->name == 'Admin')
    {{-- dashboard --}}
    <x-sidebar.link title="Dashboard" href="{{ route('admin.dashboard') }}"
        :isActive="request()->routeIs('admin.dashboard')">
        <x-slot name="icon">
            <x-fileicon-dashboard class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>
    {{-- User Control --}}
    <x-sidebar.link title="User Hub" href="{{ route('users.index') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['users.index', 'users.edit', 'users.show', 'users.create', 'users.delete', 'users.trashed'],
        )">
        <x-slot name="icon">
            <x-fas-user-cog class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    {{-- Courses Control --}}
    <x-sidebar.link title="Course Hub" href="{{ route('courses.index') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['courses.index', 'courses.edit', 'courses.show', 'courses.create', 'courses.delete', 'courses.trashed'],
        )">
        <x-slot name="icon">
            <x-iconpark-bookshelf class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>
    {{-- Sections Control --}}
    <x-sidebar.link title="Sections" href="{{ route('sections.index') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['sections.index', 'sections.create','sections.show','sections.edit','sections.delete','sections.trashed'],
        )">
        <x-slot name="icon">
            <x-fas-people-roof class="w-6 h-6"  />
        </x-slot>
    </x-sidebar.link>
    {{-- Students Control --}}
    <x-sidebar.link title="Students" href="{{ route('admin.students') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['admin.students', 'admin.show_student_courses'],
        )">
        <x-slot name="icon">
            <x-fas-user-graduate class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>
    {{-- teachers Control --}}
    <x-sidebar.link title="Teachers" href="{{ route('admin.teachers') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['admin.teachers', 'admin.show_teacher_courses'],
        )">
        <x-slot name="icon">
            <x-fas-chalkboard-teacher class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    {{-- Evalutors Control --}}
    <x-sidebar.link title="Evaluators" href="{{ route('admin.evaluators') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['admin.evaluators', 'admin.show_evaluator_courses'],
        )">
        <x-slot name="icon">
            <x-fluentui-checkbox-person-16-o class="w-6 h-6" />
            {{--
            <x-fluentui-checkbox-person-16 class="w-6 h-6" /> --}}
        </x-slot>
    </x-sidebar.link>
    @endif


    {{-- TEACHER ONLY SIDEBAR LINKS --}}
    @if (Auth::user()->role->name == 'Teacher')
    {{-- dashboard --}}
    <x-sidebar.link title="Dashboard" href="{{ route('teacher.dashboard') }}"
        :isActive="request()->routeIs('teacher.dashboard')">
        <x-slot name="icon">
            <x-fileicon-dashboard class="w-5 h-5" />

        </x-slot>
    </x-sidebar.link>
    {{-- Exam Control --}}
    <x-sidebar.link title="Exam Hub" href="{{ route('exams.index') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['exams.index','exams.create','exams.show','exams.create','exams.trashed','exams.edit','question.create','question.edit',
            ],
        )">
        <x-slot name="icon">
            <x-majestic-checkbox-list-detail-solid class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    {{-- View Results --}}
    <x-sidebar.link title="Results" href="{{route('exams.result')}}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['exams.result','exam.results'],
        )">
        <x-slot name="icon">
            <x-fas-award class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    {{-- View Statuses --}}
    <x-sidebar.link title="Statuses" href="{{route('exams.status')}}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['exams.status','exam.statuses'],
        )">
        <x-slot name="icon">
            <x-si-statuspage class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>
    @endif



    {{-- Evaluator ONLY SIDEBAR LINKS --}}
    @if (Auth::user()->role->name == 'Evaluator')
    {{-- dashboard --}}
    <x-sidebar.link title="Dashboard" href="{{ route('evaluator.dashboard') }}"
        :isActive="request()->routeIs('evaluator.dashboard')">
        <x-slot name="icon">
            <x-fileicon-dashboard class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>

    {{-- Exam Review --}}
    <x-sidebar.link title="Exam Review" href="{{route('exam-review.index')}}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['exam-review.index','exam-review.show'],
        )">
        <x-slot name="icon">
            <x-gmdi-rate-review-o class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    @endif



    {{-- STUDENT ONLY SIDEBAR LINKS --}}
    @if (Auth::user()->role->name == 'Student')
    {{-- dashboard --}}
    <x-sidebar.link title="Dashboard" href="{{ route('student.dashboard') }}"
        :isActive="request()->routeIs('student.dashboard')">
        <x-slot name="icon">
            <x-fileicon-dashboard class="w-5 h-5" />
        </x-slot>
    </x-sidebar.link>
    {{-- Exam --}}
    <x-sidebar.link title="My Exam" href="{{ route('student.exams') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['student.exams', 'student.show', 'student.exam'],
        )">
        <x-slot name="icon">
            <x-majestic-checkbox-list-detail-solid class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    {{-- Result --}}
    <x-sidebar.link title="My Result" href="{{ route('student.exam-results') }}" :isActive="in_array(
            request()
                ->route()
                ->getName(),
            ['student.exam-results',],
        )">
        <x-slot name="icon">
            <x-fas-award class="w-6 h-6" />
        </x-slot>
    </x-sidebar.link>
    @endif





</x-perfect-scrollbar>
