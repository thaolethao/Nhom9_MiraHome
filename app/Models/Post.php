<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'slug', 
        'user_id',
        'content',
        'description',
        'image',
        'status',
    ];
    public function author()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function products()
    {
    return $this->belongsToMany(Product::class, 'post_products', 'post_id', 'product_id');
    }

   
}
