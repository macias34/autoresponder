<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('SMTP configuration') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your SMTP configuration.") }}
        </p>
    </header>

    <form method="post" action="{{ route('settings.smtp-configuration.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="host" :value="__('Host')"/>
            <x-text-input id="host" name="host" type="text"
                          class="mt-1 block w-full"
                          :value="old('host', $user->smtpConfiguration['host'])"
                          required autofocus autocomplete="host"/>
            <x-input-error class="mt-2" :messages="$errors->get('host')"/>
        </div>
        <div>
            <x-input-label for="port" :value="__('Port')"/>
            <x-text-input id="port" name="port" type="number"
                          class="mt-1 block w-full"
                          :value="old('port', $user->smtpConfiguration['port'])"
                          required autofocus autocomplete="port"/>
            <x-input-error class="mt-2" :messages="$errors->get('port')"/>
        </div>
        <div>
            <x-input-label for="user" :value="__('User')"/>
            <x-text-input id="user" name="user" type="text"
                          class="mt-1 block w-full"
                          :value="old('user', $user->smtpConfiguration['user'])"
                          required autofocus autocomplete="user"/>
            <x-input-error class="mt-2" :messages="$errors->get('user')"/>
        </div>
        <div>
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" name="password" type="text"
                          class="mt-1 block w-full"
                          :value="old('password', $user->smtpConfiguration['password'])"
                          required autofocus autocomplete="password"/>
            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'imap-configuration-updated')
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
</section>
