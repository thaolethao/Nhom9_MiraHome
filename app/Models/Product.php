<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'price',
        'old_price',
        'image',
        'stock'
    ];
    
    protected $casts = [
        'price' => 'float',
        'old_price' => 'float'
    ];
}