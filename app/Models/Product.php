<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'regular_price',
        'sale_price',
        'quantity',
        'image',
        'images',
        'size',
        'color',
        'category_id',
    ];

    public function getImage()
    {
        $isUrl = Str::isUrl($this->image);
        return $isUrl ? $this->image : asset('admin/products/'.$this->image);
    }

    public function orederItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
