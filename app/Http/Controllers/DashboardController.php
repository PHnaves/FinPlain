<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        // Busca as metas relacionadas ao usuario logado
        $goals = Goal::where('user_id', $user->id)->get();

        // pegar os ids das metas
        $goal_ids = Goal::pluck('id');

        // Titulo das metas
        $goal_title = $goals->pluck('goal_title');
        // Progresso das metas
        $goal_progress = $goals->map(function ($goal) {
            return $goal->target_value > 0 ? ($goal->current_value / $goal->target_value * 100) : 0;
        });

        // Gráfico de Gastos
        $expenses = Expense::where('user_id', $user->id)->get();
        $expense_ids = $expenses->pluck('id');
        $expense_name = $expenses->pluck('expense_name');
        $expense_value = $expenses->pluck('expense_value');
        $expense_payment_date = $expenses->pluck('payment_date');

        // Status das despesas
        $expense_status = $expenses->map(function ($expense) {
            return $expense->payment_date ? 'pago' : 'nao_pago';
        });        

        return view('dashboard', compact(
            'goal_title', 'goal_progress', 'goal_ids',
            'expense_ids', 'expense_name', 'expense_value', 'expense_payment_date', 'expense_status', 'user'
        ));
    }
}
