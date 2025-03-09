<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('metas', MetaController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('renda', RendaController::class)->only(['index', 'store']);
    Route::resource('despesa', DespesaController::class)->only(['index', 'store']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
