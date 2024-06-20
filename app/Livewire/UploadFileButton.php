<?php

namespace App\Livewire;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use OpenAI\Laravel\Facades\OpenAI;


class UploadFileButton extends Component
{

    use WithFileUploads;

    public $files;
    protected $rules = [
        'files' => 'required'
    ];

    public function updatedFiles()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $fileStream = fopen($file->getRealPath(), 'r');
            $response = OpenAI::files()->upload([
                'purpose' => 'fine-tune',
                'file' => $fileStream
            ]);
            $externalId = $response->id;
            $path = Storage::putFileAs("public", $file, $file->getClientOriginalName());

            File::create(['external_id' => $externalId, 'path' => $path]);
            $this->dispatch('file-created');
        }

        $this->dispatch('file-created');
    }


    public function render()
    {
        return view('livewire.upload-file-button');
    }
}
