<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'irfan_students';
    protected $fillable = ['name', 'nim', 'email', 'phone'];
}
