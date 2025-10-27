<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterReference extends Model
{
    protected $fillable = [
        'name',
        'position',
        'company',
        'relationship',
        'phone',
        'email',
        'testimonial',
        'image',
    ];
}
