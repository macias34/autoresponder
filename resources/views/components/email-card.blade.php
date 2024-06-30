@props(['email'])


<a href="/emails/{{$email->id}}">
    <div
        class="flex justify-between text-white bg-gray-800 rounded-lg px-4 py-2 min-h-20 items-center">
        <div class="flex flex-col gap-1">
            <h3>{{ $email->subject }}</h3>
            <p class="font-semibold">
                {{ $email->personal }}
            </p>
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
</a>
