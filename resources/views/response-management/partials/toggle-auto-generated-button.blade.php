<form method="post" action="{{ route('response-management.toggle-auto-generation') }}">
    @csrf
    @method('patch')
    @if($user->auto_generated)
        <x-primary-button>Auto generated</x-primary-button>
    @else
        <x-secondary-button type="submit">Not auto generated</x-secondary-button>
    @endif
</form>
