<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function getImage()
    {
        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/categories/'.$this->image);
    }
}
