<section>
    <div class="flex flex-col">
        <x-input-label for="files" :value="__('Files')"/>
        <div
            class="grid grid-cols-6 gap-6 mt-1 border-gray-300
             dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
             focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600
             rounded-md shadow-sm p-6">
            @forelse($files as $file)
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
            @empty
                No files uploaded
            @endforelse

        </div>

        <div class="mt-6 min-h-10 flex justify-between">
            <livewire:upload-file-button/>
            @if($this->isAnySelected())
                <div class="flex gap-2">
                    <x-primary-button wire:click="includeSelectedInEmail">In/Exclude in mail</x-primary-button>
                    <x-secondary-button wire:click="deleteSelected">Delete</x-secondary-button>
                </div>
            @endif
        </div>

    </div>


</section>

