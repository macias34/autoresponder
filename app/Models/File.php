<?php

namespace App\Models;

use App\Observers\FileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[ObservedBy([FileObserver::class])]
class File extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'include_in_email'];


    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public function getNameAttribute(): string
    {
        return str_replace('public/', '', Str::limit($this->path, 50));
    }


}
