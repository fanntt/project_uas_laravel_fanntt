<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

// Route khusus admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Halaman Admin';
    });
});

// Route untuk admin dan petugas
Route::middleware(['role:admin,petugas'])->group(function () {
    Route::get('/petugas', function () {
        return 'Halaman Petugas/Admin';
    });
});

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::post('loans/{id}/approve', [LoanController::class, 'approve'])->name('loans.approve');
Route::post('loans/{id}/reject', [LoanController::class, 'reject'])->name('loans.reject');
