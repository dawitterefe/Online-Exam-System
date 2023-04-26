<div class="flex items-center justify-between flex-shrink-0 px-3">
    <!-- Logo -->
    <a
        href="{{ url('/') }}"
        class="inline-flex items-center gap-2"
        >
        <img  aria-hidden="true" src="{{ asset('storage/img/dbu-logo.png') }}" alt="Logo"  class="w-10 h-auto">
        <div class="w-10 h-auto">DBUOES</div>
        <span class="sr-only">Dashboard</span>
    </a>

    <!-- Toggle button -->
    <x-button
        type="button"
        icon-only
        sr-text="Toggle sidebar"
        variant="secondary"
        x-show="isSidebarOpen || isSidebarHovered"
        x-on:click="isSidebarOpen = !isSidebarOpen"
    >
        <x-icons.menu-fold-right
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-icons.menu-fold-left
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="hidden w-6 h-6 lg:block"
        />

        <x-heroicon-o-x
            aria-hidden="true"
            class="w-6 h-6 lg:hidden"
        />
    </x-button>
</div>
