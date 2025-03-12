<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// GASTOS
Route::middleware(['auth'])->group(function () {
    Route::get('/gasto', [GastoController::class, 'index'])->name('gastos.index'); // Listar gastos
    Route::post('/gasto', [GastoController::class, 'store'])->name('gastos.store'); // Criar gasto
    Route::get('/gasto/{gasto}/edit', [GastoController::class, 'edit'])->name('gastos.edit'); // Ver detalhes da gasto
    Route::patch('/gasto/{gasto}', [GastoController::class, 'update'])->name('gastos.update'); // Atualizar gasto
    Route::delete('/gasto/{gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy'); // Deletar gasto
});

// DASHBOARD
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// METAS
Route::middleware(['auth'])->group(function () {
    Route::get('/meta', [MetaController::class, 'index'])->name('metas.index'); // Listar metas
    Route::get('/meta/create', [MetaController::class, 'create'])->name('metas.create');
    Route::post('/meta', [MetaController::class, 'store'])->name('metas.store'); // Criar meta
    Route::get('/meta/{meta}/show', [MetaController::class, 'show'])->name('metas.show'); // Ver detalhes da meta
    Route::get('/meta/{meta}/edit', [MetaController::class, 'edit'])->name('metas.edit'); // Ver detalhes da meta
    Route::patch('/meta/{meta}', [MetaController::class, 'update'])->name('metas.update'); // Atualizar meta
    Route::delete('/meta/{meta}', [MetaController::class, 'destroy'])->name('metas.destroy'); // Deletar meta
});

// DESPESAS
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
