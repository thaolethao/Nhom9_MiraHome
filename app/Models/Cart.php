<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id']; 
    // Khai báo quan hệ với CartItem (giỏ hàng có nhiều sản phẩm)
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}

