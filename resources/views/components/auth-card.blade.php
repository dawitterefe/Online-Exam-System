<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div class="w-32 h-32">
        <a href="/">
            <x-application-logo  />
        </a>
    </div>

    <div class="w-full px-6 py-4 -my-4 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>
