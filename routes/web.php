<?php

use Illuminate\Support\Facades\Route;

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
