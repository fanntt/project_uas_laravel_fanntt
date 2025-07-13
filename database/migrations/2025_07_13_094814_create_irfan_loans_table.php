<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('irfan_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('product_id');
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'returned', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('irfan_students')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('irfan_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irfan_loans');
    }
};
