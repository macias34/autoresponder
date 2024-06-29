<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('OpenAI configuration') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your OpenAI configuration.") }}
        </p>
    </header>

    <form method="post" action="{{ route('settings.open-ai-configuration.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="openai_api_key" :value="__('OpenAI API Key')"/>
            <x-text-input id="openai_api_key" name="openai_api_key" type="text" class="mt-1 block w-full"
                          :value="old('openai_api_key', $user->openai_api_key)"
                          required autofocus autocomplete="openai_api_key"/>
            <x-input-error class="mt-2" :messages="$errors->get('openai_api_key')"/>
        </div>
        <div>
            <x-input-label for="assistant_id" :value="__('Assistant ID')"/>
            <x-text-input id="assistant_id" name="assistant_id" type="text" class="mt-1 block w-full"
                          :value="old('assistant_id', $user->assistant_id)"
                          required autofocus autocomplete="assistant_id"/>
            <x-input-error class="mt-2" :messages="$errors->get('assistant_id')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'open-ai-configuration-updated')
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
    <form class="mt-4" id="generate-assistant" method="POST" action="{{route('settings.generate-assistant')}}">
        @csrf
        @method('patch')
        <x-primary-button>{{ __('Generate assistant') }}</x-primary-button>
    </form>

</section>
