@props(['email'])


<a href="/emails/{{$email->id}}">
    <div class="flex justify-between text-white bg-gray-800 rounded-lg px-4 py-2">
        <h3>{{ $email->subject }}</h3>
        <p class="text-gray-400">{{ \Illuminate\Support\Str::limit($email->html, 50) }}</p>
    </div>
</a>
