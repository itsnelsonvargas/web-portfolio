<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'demo_url',
        'github_url',
        'technologies',
        'featured',
        'order'
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
    ];
}
