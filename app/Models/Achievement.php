<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'type',
        'issuer',
        'description',
        'date',
        'icon',
        'url',
        'order',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
