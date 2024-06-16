<?php

namespace App\Livewire;

use App\Models\File;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectableFilesForm extends Component
{
    public $files = [];
    public $selectedFilesPaths = [];

    public function mount(): void
    {
        $this->files = $this->loadFiles();
        $this->selectedFilesPaths = [];
    }

    private function loadFiles(): Collection
    {
        return File::all();
    }

    #[On('file-created')]
    public function updateFiles()
    {
        $this->files = $this->loadFiles();
    }

    public function toggleSelect($path): void
    {
        if (($key = array_search($path, $this->selectedFilesPaths)) !== false) {
            unset($this->selectedFilesPaths[$key]);
        } else {
            $this->selectedFilesPaths[] = $path;
        }
        $this->selectedFilesPaths = array_values($this->selectedFilesPaths);
    }

    public function isSelected($path): bool
    {
        return in_array($path, $this->selectedFilesPaths);
    }

    public function isAnySelected(): bool
    {
        return count($this->selectedFilesPaths) > 0;
    }

    public function deleteSelected(): void
    {
        $files = $this->getSelectedFiles();
        foreach ($files as $file) {
            $file->delete();
        }
        $this->selectedFilesPaths = [];
        $this->files = $this->loadFiles();
    }

    private function getSelectedFiles(): Collection
    {
        return File::whereIn('path', $this->selectedFilesPaths)->get();
    }

    public function includeSelectedInEmail(): void
    {
        $files = $this->getSelectedFiles();
        foreach ($files as $file) {
            $file->update(['include_in_email' => !$file['include_in_email']]);
        }

        $this->selectedFilesPaths = [];
        $this->files = $this->loadFiles();
    }

    public function render(): View
    {
        return view('livewire.selectable-files-form');
    }
}
