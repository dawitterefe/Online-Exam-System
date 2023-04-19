<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">


    @if (Auth::user()->role->name == 'Admin')
        {{-- dashboard --}}
        <x-sidebar.link title="Dashboard" href="{{ route('admin.dashboard') }}" :isActive="request()->routeIs('admin.dashboard')">
            <x-slot name="icon">
                <x-fileicon-dashboard class="w-5 h-5" />
            </x-slot>
        </x-sidebar.link>

        {{-- User Administration --}}

        <x-sidebar.dropdown title="User Control" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'user',
        )">
            <x-slot name="icon">
                <x-fas-user-cog class="w-6 h-6" />
            </x-slot>

            <x-sidebar.sublink title="All Users" href="{{ route('user.index') }}" :active="request()->routeIs('user.index')" />
            <x-sidebar.sublink title="Students" href="{{ route('buttons.text') }}" :active="request()->routeIs('buttons.text')" />
            <x-sidebar.sublink title="Teachers" href="{{ route('buttons.icon') }}" :active="request()->routeIs('buttons.icon')" />
            <x-sidebar.sublink title="Exam-Committe" href="{{ route('buttons.text-icon') }}" :active="request()->routeIs('buttons.text-icon')" />
        </x-sidebar.dropdown>
    @endif


    @if (Auth::user()->role->name == 'Student')
        <x-sidebar.link title="Dashboard" href="{{ route('student.dashboard') }}" :isActive="request()->routeIs('student.dashboard')">
            <x-slot name="icon">
                <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif














    {{--
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Dummy Links
    </div>

    @php
        $links = array_fill(0, 20, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>
