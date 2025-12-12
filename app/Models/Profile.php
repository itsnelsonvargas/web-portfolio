<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'email',
        'phone',
        'location',
        'profile_image',
        'resume_url',
    ];

    public function profileImageUrl(): ?string
    {
        if (! $this->profile_image) {
            return null;
        }

        // If the value looks like a URL, use it as-is; otherwise assume storage path.
        if (str_starts_with($this->profile_image, ['http://', 'https://'])) {
            return $this->profile_image;
        }

        return Storage::disk('public')->url($this->profile_image);
    }
}
