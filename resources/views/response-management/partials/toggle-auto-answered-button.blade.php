<form method="post" action="{{ route('response-management.toggle-auto-answered') }}">
    @csrf
    @method('patch')
    @if($user->auto_answered)
        <x-primary-button>Auto answered</x-primary-button>
    @else
        <x-secondary-button type="submit">Not auto answered</x-secondary-button>
    @endif
</form>
