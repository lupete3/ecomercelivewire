<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    public function getImage()
    {
        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/slider/'.$this->image);
    }
}
