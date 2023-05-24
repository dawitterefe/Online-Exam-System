<x-app-layout>
    <x-slot name="header">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="inline-flex items-center gap-2">
                <div>
                    <x-gmdi-edit-document class="w-8 h-8" />
                </div>
                <h2 class="text-xl font-semibold leading-tight">
                    {{ __('Edit Section Data') }}
                </h2>
            </div>
            <a href="{{ URL::previous() }}"
                class="middle none center rounded-lg bg-cyan-500 py-2 px-3 font-sans text-xs font-bold  text-white shadow-md shadow-cyan-500/20 transition-all hover:shadow-lg-underline hover:shadow-cyan-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>

    </x-slot>

    <!-- component -->
    <div class="max-w-xl mt-0 mx-auto">
        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle bg-white shadow sm:rounded-lg dark:bg-gray-800">

                    <div class=" mx-9 my-7 ">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('sections.update', $section->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- change section name --}}
                            <div class="space-y-2">
                                <x-form.label for="name" :value="__('Section Name')" />

                                <x-form.input id="name" name="name" type="text" class="block w-full"
                                    :value="old('name', $section->name)" required autofocus autocomplete="name" />

                                <x-form.error :messages="$errors->get('name')" />
                            </div>

                            <div class="flex items-center gap-3 py-3">
                                {{-- change year --}}
                                <div class="space-y-2 w-full">
                                    <x-form.label for="year" :value="__('Year')" />

                                    <x-form.input id="year" name="year" type="text" class="block w-full"
                                        :value="old('year', $section->year)" required autofocus autocomplete="year" />

                                    <x-form.error :messages="$errors->get('year')" />
                                </div>

                                {{-- Semister --}}
                                <div class="space-y-2 w-full">
                                    <x-form.label for="semester" :value="__('Semester')" />

                                    <select id="semester" name="semester"
                                        class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                                        <option {{'First'==$section->semester ? 'selected' : '' }} value=" First">1st
                                            Semester</option>
                                        <option {{'Second'==$section->semester ? 'selected' : '' }} value="Second">2nd
                                            Semester</option>
                                        <option {{'Summer'==$section->semester ? 'selected' : '' }}
                                            value="Summer">Summer
                                        </option>
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <div class="flex items-center gap-3 mb-3">
                                {{-- change program --}}
                                <div class="space-y-2 w-full">
                                    <x-form.label for="program" :value="__('Program')" />

                                    <x-form.input id="program" name="program" type="text" class="block w-full"
                                        :value="old('program', $section->program)" required autofocus
                                        autocomplete="program" />

                                    <x-form.error :messages="$errors->get('program')" />
                                </div>

                                {{-- Degree Level --}}
                                <div class="space-y-2 w-full">
                                    <x-form.label for="degree_level" :value="__('Degree level')" />

                                    <select id="degree_level" name="degree_level"
                                        class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                                        <option {{"Bachelor's"==$section->degree_level ? 'selected' : '' }}
                                            value="Bachelor's">Bachelor's Degree</option>
                                        <option {{"Master's"==$section->degree_level ? 'selected' : '' }}
                                            value="Master's">Master's Degree</option>
                                        <option {{"Doctoral"==$section->degree_level ? 'selected' : '' }}
                                            value="Doctoral">Doctoral Degree</option>
                                        </option>
                                    </select>
                                </div>

                            </div>
                            {{-- Type --}}
                            <div class="space-y-2  mb-2">
                                <x-form.label for="type" :value="__('Degree level')" />

                                <select id="type" name="type"
                                    class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                                    <option {{"Regular"==$section->type ? 'selected' : '' }} value="Regular">Regular
                                    </option>
                                    <option {{"Extension"==$section->type ? 'selected' : '' }}
                                        value="Extension">Extension</option>
                                    <option {{"Distance"==$section->type ? 'selected' : '' }} value="Distance">Distancee
                                    </option>
                                    <option {{"Summer"==$section->type ? 'selected' : '' }} value="Summer">Summer
                                    </option>

                                    </option>
                                </select>
                            </div>




                            {{-- save --}}
                            <div class="mt-5 flex justify-end">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <x-button>
                                            {{ __('Update') }}
                                        </x-button>
                                    </div>
                                    <div>
                                        @if (session('status') === 'updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                            {{ __('Updated.') }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>
