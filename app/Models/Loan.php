<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'irfan_loans';
    protected $fillable = ['student_id', 'product_id', 'loan_date', 'return_date', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
