<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'original_name',
        'path',
        'disk',
        'mime_type',
        'size',
        'extension',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'size' => 'integer',
    ];

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_upload');
    }

    public function url(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}

