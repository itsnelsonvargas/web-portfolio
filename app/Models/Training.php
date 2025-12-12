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
        'started_at',
        'ended_at',
        'acquired_at',
        'credential_id',
        'link',
        'tags',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'acquired_at' => 'date',
    ];

    public function uploads()
    {
        return $this->belongsToMany(Upload::class, 'training_upload');
    }
}

