<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    protected $fillable = ['title', 'description'];
}
