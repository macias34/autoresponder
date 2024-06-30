@props(['email'])


<a href="/emails/{{$email->id}}">
    <div class="flex justify-between text-white bg-gray-800 rounded-lg px-4 py-2">
        <p class="font-semibold">
            {{ $email->personal }}
        </p>
        <h3>{{ $email->subject }}</h3>
    </div>
</a>
