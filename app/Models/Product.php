<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description', // dùng thay long/short
    'image',
    'sub_images',
    'price',
    "old_price",
    'stock',
    'has_variants',
    'is_hot',
    'is_most_viewed',
    'status',
    'category_id',
];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function getFinalPriceAttribute()
    {
        $discount = $this->discounts()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($discount) {
            if ($discount->discount_percentage) {
                return $this->price * (1 - $discount->discount_percentage / 100);
            } elseif ($discount->discount_amount) {
                return $this->price - $discount->discount_amount;
            }
        }

        return $this->price;
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function posts()
    {
    return $this->belongsToMany(Post::class, 'post_products', 'post_id', 'product_id');
    }

}
