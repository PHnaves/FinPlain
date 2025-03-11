<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('metas', MetaController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/despesa', [DespesaController::class, 'index'])->name('despesas.index'); // Listar despesas
    Route::post('/despesa', [DespesaController::class, 'store'])->name('despesas.store'); // Criar despesa
    Route::get('/despesa/{despesa}/show', [DespesaController::class, 'show'])->name('despesas.show'); // Ver detalhes da despesa
    Route::get('/despesa/{despesa}/edit', [DespesaController::class, 'edit'])->name('despesas.edit'); // Ver detalhes da despesa
    Route::patch('/despesa/{despesa}', [DespesaController::class, 'update'])->name('despesas.update'); // Atualizar despesa
    Route::delete('/despesa/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy'); // Deletar despesa
});



Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
