<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;

Route::get('/', [MainController::class, 'index']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{family_uid}', [MainController::class, 'home'])
    ->where('family_uid', '^\d{10}$') 
    ->name('home');
