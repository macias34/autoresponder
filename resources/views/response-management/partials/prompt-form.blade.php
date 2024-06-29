<form method="post" action="{{ route('response-management.update-prompt') }}">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="prompt" :value="__('Prompt')"/>
        <x-text-area id="prompt" name="prompt" type="text"
                     class="mt-1 block w-full"
                     :value="old('prompt', $user->prompt)"
                     required autofocus autocomplete="prompt"
                     rows="4"
        />
        <x-input-error class="mt-2" :messages="$errors->get('prompt')"/>
    </div>


    <div class="flex items-center gap-4">
        <x-primary-button class="mt-6">{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'prompt-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
