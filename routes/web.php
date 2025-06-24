<?php

use App\Http\Controllers\ContactController;
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
    Route::post('/deposito/{expense}', [DepositController::class, 'payExpense'])->name('pay.expense');
    Route::post('/deposito/{goal}', [DepositController::class, 'depositGoal'])->name('deposit.goal');
});

//NOTIFICACOES
Route::middleware('auth')->group(function () {
    Route::get('/notificacoes', [NotificationsController::class, 'index'])->name('notifications');
    Route::post('/notificacoes/{id}/lida', [NotificationsController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('/notificacoes/{id}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
});

//RELATORIOS
Route::middleware(['auth'])->group(function () {
    Route::get('/relatorio', [RecordController::class, 'index'])->name('records.index');
    Route::get('/relatorio/gerar', [RecordController::class, 'generatePdf'])->name('records.generate');
    Route::post('/relatorio/filtrar', [RecordController::class, 'filterExpenses'])->name('records.filter');
});

// INVESTIMENTOS
Route::middleware(['auth'])->group(function () {
    Route::get('/investimentos', [InvestimentController::class, 'index'])->name('investiments.index');
});

// DASHBOARD
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// METAS
Route::middleware(['auth'])->group(function () {
    Route::get('/meta', [GoalController::class, 'index'])->name('metas.index'); // Listar metas
    Route::get('/meta/criar', [GoalController::class, 'create'])->name('metas.create');
    Route::post('/meta', [GoalController::class, 'store'])->name('metas.store'); // Criar meta
    Route::get('/meta/{goal}/detalhes', [GoalController::class, 'show'])->name('metas.show'); // Ver detalhes da meta
    Route::get('/meta/{goal}/editar', [GoalController::class, 'edit'])->name('metas.edit'); // Ver detalhes da meta
    Route::patch('/meta/{goal}', [GoalController::class, 'update'])->name('metas.update'); // Atualizar meta
    Route::delete('/meta/{goal}', [GoalController::class, 'destroy'])->name('metas.destroy'); // Deletar meta
});

// DESPESAS
Route::middleware(['auth'])->group(function () {
    Route::get('/despesa', [ExpenseController::class, 'index'])->name('despesas.index'); // Listar despesas
    Route::get('/despesa/criar', [ExpenseController::class, 'create'])->name('despesas.create'); // Formulário de criação
    Route::post('/despesa', [ExpenseController::class, 'store'])->name('despesas.store'); // Criar despesa
    Route::get('/despesa/{expense}/detalhes', [ExpenseController::class, 'show'])->name('despesas.show'); // Ver detalhes da despesa
    Route::get('/despesa/{expense}/editar', [ExpenseController::class, 'edit'])->name('despesas.edit'); // Ver detalhes da despesa
    Route::patch('/despesa/{expense}', [ExpenseController::class, 'update'])->name('despesas.update'); // Atualizar despesa
    Route::delete('/despesa/{expense}', [ExpenseController::class, 'destroy'])->name('despesas.destroy'); // Deletar despesa
});

// GANHOS
Route::middleware(['auth'])->group(function () {
    Route::get('/ganho', [EarningController::class, 'index'])->name('ganhos.index'); // Listar ganhos
    Route::get('/ganho/criar', [EarningController::class, 'create'])->name('ganhos.create'); // Formulário de criação
    Route::post('/ganho', [EarningController::class, 'store'])->name('ganhos.store'); // Criar ganho
    Route::get('/ganho/{earning}/detalhes', [EarningController::class, 'show'])->name('ganhos.show'); // Ver detalhes do ganho
    Route::get('/ganho/{earning}/editar', [EarningController::class, 'edit'])->name('ganhos.edit'); // Editar ganho
    Route::patch('/ganho/{earning}', [EarningController::class, 'update'])->name('ganhos.update'); // Atualizar ganho
    Route::delete('/ganho/{earning}', [EarningController::class, 'destroy'])->name('ganhos.destroy'); // Deletar ganho
});

//PAGINA BOAS VINDAS
Route::get('/', function () {
    return view('welcome');
});

Route::post('/contato', [ContactController::class, 'store'])->name('contato.store');

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
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';