<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];
    
    // Quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Hàm để lấy giá trị price từ bảng Product khi tạo cart item
    public static function boot()
    {
        parent::boot();

        static::creating(function ($cartItem) {
            // Lấy giá sản phẩm từ bảng Product và gán cho price
            $product = Product::find($cartItem->product_id);
            if ($product) {
                $cartItem->price = $product->price;
            }
        });
    }
}
