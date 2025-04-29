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

// DEPOSITOS
Route::middleware(['auth'])->group(function () {
    Route::post('/deposit/{expense}', [DepositController::class, 'pagarDespesa'])->name('despesas.pagar');
    Route::post('/deposit/{goal}/deposit', [DepositController::class, 'depositar'])->name('deposit');
});

//NOTIFICACOES
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notificacoes');
    Route::post('/notifications/{id}/markAsRead', [NotificationsController::class, 'marcarComoLida'])->name('notificacoes.marcarComoLida');
    Route::delete('/notifications/{id}', [NotificationsController::class, 'excluir'])->name('notificacoes.excluir');
});

//RELATORIOS
Route::middleware(['auth'])->group(function () {
    Route::get('/record', [RecordController::class, 'index'])->name('relatorio.index');
    Route::get('/record/generate', [RecordController::class, 'generatePdf'])->name('relatorio.gerar');
    Route::post('/record/filter', [RecordController::class, 'filterExpenses'])->name('relatorios.filtrar');
});

// INVESTIMENTOS
Route::middleware(['auth'])->group(function () {
    Route::get('/investiments', [InvestimentController::class, 'index'])->name('investimentos');
});

// DASHBOARD
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// METAS
Route::middleware(['auth'])->group(function () {
    Route::get('/goal', [GoalController::class, 'index'])->name('metas.index'); // Listar metas
    Route::get('/goal/create', [GoalController::class, 'create'])->name('metas.create');
    Route::post('/goal', [GoalController::class, 'store'])->name('metas.store'); // Criar meta
    Route::get('/goal/{goal}/show', [GoalController::class, 'show'])->name('metas.show'); // Ver detalhes da meta
    Route::get('/goal/{goal}/edit', [GoalController::class, 'edit'])->name('metas.edit'); // Ver detalhes da meta
    Route::patch('/goal/{goal}', [GoalController::class, 'update'])->name('metas.update'); // Atualizar meta
    Route::delete('/goal/{goal}', [GoalController::class, 'destroy'])->name('metas.destroy'); // Deletar meta
});

// DESPESAS
Route::middleware(['auth'])->group(function () {
    Route::get('/expense', [ExpenseController::class, 'index'])->name('despesas.index'); // Listar despesas
    Route::post('/expense', [ExpenseController::class, 'store'])->name('despesas.store'); // Criar despesa
    Route::get('/expense/{expense}/show', [ExpenseController::class, 'show'])->name('despesas.show'); // Ver detalhes da despesa
    Route::get('/expense/{expense}/edit', [ExpenseController::class, 'edit'])->name('despesas.edit'); // Ver detalhes da despesa
    Route::patch('/expense/{expense}', [ExpenseController::class, 'update'])->name('despesas.update'); // Atualizar despesa
    Route::delete('/expense/{expense}', [ExpenseController::class, 'destroy'])->name('despesas.destroy'); // Deletar despesa
});


//PAGINA BOAS VINDAS
Route::get('/', function () {
    return view('welcome');
});

//PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
