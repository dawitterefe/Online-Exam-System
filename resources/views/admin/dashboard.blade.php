<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex items-center gap-2">

            <div>
                <x-fileicon-dashboard class="w-8 h-8" />

            </div>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>

        </div>
    </x-slot>


</x-app-layout>