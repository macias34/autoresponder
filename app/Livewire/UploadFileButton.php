<?php

namespace App\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

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
            $path = $file->storeAs('public', $file->getClientOriginalName());

            File::create([
                'path' => $path
            ]);
        }
        $this->dispatch('file-created');
    }

    public function render()
    {
        return view('livewire.upload-file-button');
    }
}
