<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'irfan_products';
    protected $fillable = ['name', 'category_id', 'stock', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
