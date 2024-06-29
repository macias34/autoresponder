<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Imap configuration') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your imap configuration.") }}
        </p>
    </header>

    <form method="post" action="{{ route('settings.imap-configuration.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="imap_configuration_host" :value="__('Host')"/>
            <x-text-input id="imap_configuration_host" name="imap_configuration[host]" type="text"
                          class="mt-1 block w-full"
                          :value="old('imap_configuration.host', $user->imapConfiguration['host'])"
                          required autofocus autocomplete="imap_configuration.host"/>
            <x-input-error class="mt-2" :messages="$errors->get('imap_configuration.host')"/>
        </div>
        <div>
            <x-input-label for="imap_configuration_port" :value="__('Port')"/>
            <x-text-input id="imap_configuration_port" name="imap_configuration[port]" type="number"
                          class="mt-1 block w-full"
                          :value="old('imap_configuration.port', $user->imapConfiguration['port'])"
                          required autofocus autocomplete="imap_configuration.port"/>
            <x-input-error class="mt-2" :messages="$errors->get('imap_configuration.port')"/>
        </div>
        <div>
            <x-input-label for="imap_configuration_username" :value="__('Username')"/>
            <x-text-input id="imap_configuration_username" name="imap_configuration[username]" type="text"
                          class="mt-1 block w-full"
                          :value="old('imap_configuration.username', $user->imapConfiguration['username'])"
                          required autofocus autocomplete="imap_configuration.username"/>
            <x-input-error class="mt-2" :messages="$errors->get('imap_configuration.username')"/>
        </div>
        <div>
            <x-input-label for="imap_configuration_password" :value="__('Password')"/>
            <x-text-input id="imap_configuration_password" name="imap_configuration[password]" type="text"
                          class="mt-1 block w-full"
                          :value="old('imap_configuration.password', $user->imapConfiguration['password'])"
                          required autofocus autocomplete="imap_configuration.password"/>
            <x-input-error class="mt-2" :messages="$errors->get('imap_configuration.password')"/>
        </div>
        <div>
            <x-input-label for="imap_configuration_encryption" :value="__('Encryption')"/>
            <x-text-input id="imap_configuration_encryption" name="imap_configuration[encryption]" type="text"
                          class="mt-1 block w-full"
                          :value="old('imap_configuration.encryption', $user->imapConfiguration['encryption'])"
                          required autofocus autocomplete="imap_configuration.encryption"/>
            <x-input-error class="mt-2" :messages="$errors->get('imap_configuration.encryption')"/>
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
