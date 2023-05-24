<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-gmdi-delete-sweep class="w-9 h-9" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Trashed sections') }}
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
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">

                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-300 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-large tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        <span>#</span>
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Program
                                    </th>
                                    <th scope="col"
                                        class="py-3 pr-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Year
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-3 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Semister
                                    </th>
                                    <th scope="col"
                                        class="py-3 pl-3 pr-6 text-xs  tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Type
                                    </th>


                                    <th scope="col" class=" px-2  w-1 ">
                                        <span class="sr-only">restore</span>
                                    </th>


                                    <th scope="col" class="px-6  w-1">
                                        <span class="sr-only">Delete</span>
                                    </th>



                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                @foreach ($sections as $section)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-5 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ ($sections->currentPage() - 1) * $sections->perPage() + $loop->iteration }}
                                    </td>
                                    <td
                                        class="py-5 px-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $section->name }}</td>
                                    <td
                                        class="w-[80x] truncate py-5 px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="w-35 truncate">
                                            {{ $section->program }}
                                        </div>
                                    </td>

                                    <td
                                        class="py-5 pr-3 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $section->year }}</td>
                                    <td
                                        class="py-5 px-3 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $section->semester }}</td>
                                    <td
                                        class="py-5 pl-3 pr-6 text-sm font-medium text-gray-700 whitespace-nowrap dark:text-white">
                                        {{ $section->type}}</td>


                                    <td class="py-5 pr-2 pl-1 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="{{ route('sections.restore', $section->id) }}"
                                            class="middle none center rounded-lg bg-green-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg-underline hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="fa fa-undo" aria-hidden="true"></i> Restore</a>
                                    </td>


                                    <td class="py-5 pr-6 pl-2 text-sm font-medium text-right whitespace-nowrap">

                                        <form action="{{ route('sections.force_delete', $section->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="middle none center rounded-lg bg-red-500 py-1 px-2 font-sans text-xs font-bold  text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                data-ripple-light="true">
                                                <i class="fa fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="px-4 py-2 bg-gray-300 dark:bg-gray-700 ">

                        {{ $sections->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>
