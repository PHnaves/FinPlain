<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\InvestimentController;
use App\Http\Controllers\LembreteController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\NotificationsController;

Route::post('/deposito/{expense}', [DepositController::class, 'pagarDespesa'])->name('despesas.pagar');

Route::post('/deposito/{goal}', [DepositController::class, 'depositar'])->name('deposito');

Route::prefix('notificacoes')->middleware('auth')->group(function () {
    Route::get('/', [NotificationsController::class, 'index'])->name('notificacoes');
    Route::post('/{id}/marcar-como-lida', [NotificationsController::class, 'marcarComoLida'])->name('notificacoes.marcarComoLida');
    Route::delete('/{id}', [NotificationsController::class, 'excluir'])->name('notificacoes.excluir');
});

Route::get('/relatorio', [RecordController::class, 'index'])->name('relatorio.index');
Route::get('/relatorio/gerar', [RecordController::class, 'generatePdf'])->name('relatorio.gerar');
Route::post('/relatorios/filtrar', [RecordController::class, 'filterExpenses'])->name('relatorios.filtrar');

// Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
// Route::get('/relatorio/gerar', [RelatorioController::class, 'gerarPDF'])->name('relatorio.gerar');
// Route::post('/relatorios/filtrar', [RelatorioController::class, 'filtarGastos'])->name('relatorios.filtrar');

Route::get('/investimentos', [InvestimentController::class, 'index'])->name('investimentos');

// DASHBOARD
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// METAS
Route::middleware(['auth'])->group(function () {
    Route::get('/meta', [GoalController::class, 'index'])->name('metas.index'); // Listar metas
    Route::get('/meta/create', [GoalController::class, 'create'])->name('metas.create');
    Route::post('/meta', [GoalController::class, 'store'])->name('metas.store'); // Criar meta
    Route::get('/meta/{goal}/show', [GoalController::class, 'show'])->name('metas.show'); // Ver detalhes da meta
    Route::get('/meta/{goal}/edit', [GoalController::class, 'edit'])->name('metas.edit'); // Ver detalhes da meta
    Route::patch('/meta/{goal}', [GoalController::class, 'update'])->name('metas.update'); // Atualizar meta
    Route::delete('/meta/{goal}', [GoalController::class, 'destroy'])->name('metas.destroy'); // Deletar meta
});

// DESPESAS
Route::middleware(['auth'])->group(function () {
    Route::get('/despesa', [ExpenseController::class, 'index'])->name('despesas.index'); // Listar despesas
    Route::post('/despesa', [ExpenseController::class, 'store'])->name('despesas.store'); // Criar despesa
    Route::get('/despesa/{expense}/show', [ExpenseController::class, 'show'])->name('despesas.show'); // Ver detalhes da despesa
    Route::get('/despesa/{expense}/edit', [ExpenseController::class, 'edit'])->name('despesas.edit'); // Ver detalhes da despesa
    Route::patch('/despesa/{expense}', [ExpenseController::class, 'update'])->name('despesas.update'); // Atualizar despesa
    Route::delete('/despesa/{expense}', [ExpenseController::class, 'destroy'])->name('despesas.destroy'); // Deletar despesa
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
