<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tambah', [DashboardController::class, 'create'])->name('tambah');
    Route::post('/tambah', [DashboardController::class, 'store']);
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('hapus');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update');



});

require __DIR__.'/auth.php';