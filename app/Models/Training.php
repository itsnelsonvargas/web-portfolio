<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'organization',
        'acquired_at',
        'credential_id',
        'link',
        'tags',
    ];

    protected $casts = [
        'acquired_at' => 'date',
    ];

    public function uploads()
    {
        return $this->belongsToMany(Upload::class, 'training_upload');
    }
}

