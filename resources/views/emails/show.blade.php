<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($email->subject) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden text-white mb-4 p-4 shadow-sm sm:rounded-lg bg-gray-800 flex flex-col gap-4">
                <h2 class="text-xl font-semibold">
                    {{ $email->personal }}
                    <span class="text-sm text-gray-400">
                        {{ $email->from}}
                    </span>
                </h2>
                <p class="text-sm">
                    {{ $email->text }}
                </p>
            </div>

            @if($email->response)
                <div
                    class="overflow-hidden text-white mb-4 p-4 shadow-sm sm:rounded-lg bg-gray-800 flex flex-col gap-2">
                    <h2 class="text-xl font-semibold">
                        Response
                    </h2>

                    <p class="text-sm">
                        {{ $email->response }}
                    </p>
                </div>

            @endif
            <div class="flex items-center justify-between">
                <div class="flex gap-3">
                    <x-primary-button form="generate-response">Generate response</x-primary-button>
                    <x-primary-button :disabled="is_null($email->response) || $email->answered" form="answer">Answer
                    </x-primary-button>
                </div>

                <div class="flex gap-3">
                    @if($email->answered)
                        <x-badge color="green">Answered</x-badge>
                    @else
                        <x-badge color="yellow">Not Answered</x-badge>
                    @endif

                    @if($email->response)
                        <x-badge color="blue">Response generated</x-badge>
                    @else
                        <x-badge color="yellow">Response not generated</x-badge>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <form id="generate-response" method="POST" action="{{ route('emails.generate-response', [$email]) }}">
        @csrf
    </form>
    <form id="answer" method="POST" action="{{ route('emails.answer', [$email]) }}">
        @csrf
    </form>
</x-app-layout>



