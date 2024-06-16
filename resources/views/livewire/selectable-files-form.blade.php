<div class="flex flex-col">
    <div class="self-end flex gap-2 mb-6 min-h-10">
        @if($this->isAnySelected())
            <x-primary-button wire:click="includeSelectedInEmail">In/Exclude in mail</x-primary-button>
            <x-secondary-button wire:click="deleteSelected">Delete</x-secondary-button>
        @endif

    </div>

    <div class="grid grid-cols-6 gap-6">
        @foreach($files as $file)
            <div
                wire:key="{{ $file['path'] }}"
                wire:click=" toggleSelect('{{ $file['path'] }}')"
                class="
            {{ $this->isSelected($file['path']) ? 'bg-gray-600' : 'bg-gray-800' }}
            p-6 flex items-center cursor-pointer text-sm rounded-lg justify-center break-all aspect-square
            overflow-ellipsis relative">
                @if($file['include_in_email'])
                    <div class="absolute top-2 right-2 bg-gray-200 text-gray-800 px-2 text-sm rounded-lg">
                        Included
                    </div>
                @endif

                {{ $file->name }}


                <a class="absolute bottom-2 right-2 text-sm" href="{{ $file->url }}">
                    Preview
                </a>
            </div>
        @endforeach
    </div>

</div>
