<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    public $fillable = [
        'top_title',
        'slug',
        'title',
        'sub_title',
        'offer',
        'link',
        'image',
        'status',
        'type',
        'start_date',
        'end_date',
    ];

    public function getImage()
    {
        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/slider/'.$this->image);
    }
}
