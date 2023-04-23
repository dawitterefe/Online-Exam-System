<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">


    @if (Auth::user()->role->name == 'Admin')
        {{-- dashboard --}}
        <x-sidebar.link title="Dashboard" href="{{ route('admin.dashboard') }}" :isActive="request()->routeIs('admin.dashboard')">
            <x-slot name="icon">
                <x-fileicon-dashboard class="w-5 h-5" />
            </x-slot>
        </x-sidebar.link>

        {{-- User Control --}}
        <x-sidebar.link title="User Control" href="{{ route('users.index') }}" :isActive="in_array(request()->route()->getName(), ['users.index', 'users.edit', 'users.show','users.create' ,'users.delete'])">
            <x-slot name="icon">
                <x-fas-user-cog class="w-6 h-6" />
            </x-slot>
        </x-sidebar.link>

        {{-- User Control --}}
        <x-sidebar.link title="Course Hub" href="{{ route('courses.index') }}" :isActive="in_array(request()->route()->getName(), ['courses.index', 'courses.edit', 'courses.show','courses.create' ,'courses.delete'])">
            <x-slot name="icon">
                <x-iconpark-bookshelf class="w-5 h-5"/>
            </x-slot>
        </x-sidebar.link>





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
