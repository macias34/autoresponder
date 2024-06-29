<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Response management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-l flex flex-col gap-6">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Prompt management') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("This will affect all of your email prompts.") }}
                    </p>
                </header>
                @include('response-management.partials.toggle-auto-generation-button')
                @include('response-management.partials.prompt-form')
                <livewire:selectable-files-form/>
            </div>
        </div>
    </div>
</x-app-layout>
