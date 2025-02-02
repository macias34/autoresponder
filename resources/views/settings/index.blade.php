<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-l flex flex-col gap-6">
                @include('settings.partials.update-open-ai-configuration')
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-l flex flex-col gap-6">
                @include('settings.partials.update-smtp-configuration-form')
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-l flex flex-col gap-6">
                @include('settings.partials.update-imap-configuration-form')
            </div>

        </div>
    </div>
</x-app-layout>
