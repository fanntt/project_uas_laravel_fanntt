<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'irfan_categories';
    protected $fillable = ['name'];
}
