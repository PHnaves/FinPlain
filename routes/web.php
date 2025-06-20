<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\InvestimentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\EarningController;

// DEPOSITOS
Route::middleware(['auth'])->group(function () {
    Route::post('/deposit/{expense}', [DepositController::class, 'payExpense'])->name('pay.expense');
    Route::post('/deposit/{goal}/deposit', [DepositController::class, 'depositGoal'])->name('deposit.goal');
});

//NOTIFICACOES
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::post('/notifications/{id}/markAsRead', [NotificationsController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
});

//RELATORIOS
Route::middleware(['auth'])->group(function () {
    Route::get('/record', [RecordController::class, 'index'])->name('records.index');
    Route::get('/record/generate', [RecordController::class, 'generatePdf'])->name('records.generate');
    Route::post('/record/filter', [RecordController::class, 'filterExpenses'])->name('records.filter');
});

// INVESTIMENTOS
Route::middleware(['auth'])->group(function () {
    Route::get('/investiments', [InvestimentController::class, 'index'])->name('investiments.index');
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
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('despesas.create'); // Formulário de criação
    Route::post('/expense', [ExpenseController::class, 'store'])->name('despesas.store'); // Criar despesa
    Route::get('/expense/{expense}/show', [ExpenseController::class, 'show'])->name('despesas.show'); // Ver detalhes da despesa
    Route::get('/expense/{expense}/edit', [ExpenseController::class, 'edit'])->name('despesas.edit'); // Ver detalhes da despesa
    Route::patch('/expense/{expense}', [ExpenseController::class, 'update'])->name('despesas.update'); // Atualizar despesa
    Route::delete('/expense/{expense}', [ExpenseController::class, 'destroy'])->name('despesas.destroy'); // Deletar despesa
});

// GANHOS
Route::middleware(['auth'])->group(function () {
    Route::get('/earning', [EarningController::class, 'index'])->name('ganhos.index'); // Listar ganhos
    Route::get('/earning/create', [EarningController::class, 'create'])->name('ganhos.create'); // Formulário de criação
    Route::post('/earning', [EarningController::class, 'store'])->name('ganhos.store'); // Criar ganho
    Route::get('/earning/{earning}/show', [EarningController::class, 'show'])->name('ganhos.show'); // Ver detalhes do ganho
    Route::get('/earning/{earning}/edit', [EarningController::class, 'edit'])->name('ganhos.edit'); // Editar ganho
    Route::patch('/earning/{earning}', [EarningController::class, 'update'])->name('ganhos.update'); // Atualizar ganho
    Route::delete('/earning/{earning}', [EarningController::class, 'destroy'])->name('ganhos.destroy'); // Deletar ganho
});

//PAGINA BOAS VINDAS
Route::get('/', function () {
    return view('welcome');
});

//TERMOS E POLITICA DE PRIVACIDADE
Route::get('/termos-de-uso', function () {
    return view('termos.termosUso');
})->name('termos.termosUso'); 

Route::get('/termos-de-servico', function () {
    return view('termos.termosServico');
})->name('termos.termosServico'); 

Route::get('/politica-de-privacidade', function () {
    return view('termos.politicaPrivacidade');
})->name('termos.politicaPrivacidade');

//PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';