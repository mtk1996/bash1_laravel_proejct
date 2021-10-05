<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable  = ['category_id', 'slug', 'title', 'image', 'description', 'total_quantity', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cart()
    {
        return $this->hasMany(Product::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }
    public function size()
    {
        return $this->belongsToMany(Size::class, 'size_product');
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
