<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orederItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
