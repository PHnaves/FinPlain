<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Earning;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Filtros
        $selectedYear = $request->get('year', date('Y'));
        $selectedMonth = $request->get('month', date('n'));

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

        // Gráfico de Gastos com filtros
        $expenses = Expense::where('user_id', $user->id)
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->get();
        
        $expense_ids = $expenses->pluck('id');
        $expense_name = $expenses->pluck('expense_name');
        $expense_value = $expenses->pluck('expense_value');
        $expense_payment_date = $expenses->pluck('payment_date');

        // Status das despesas
        $expense_status = $expenses->map(function ($expense) {
            return $expense->payment_date ? 'pago' : 'nao_pago';
        });

        // Dados de Ganhos com filtros
        $earnings = Earning::where('user_id', $user->id)
            ->whereYear('received_at', $selectedYear)
            ->whereMonth('received_at', $selectedMonth)
            ->get();

        $earning_ids = $earnings->pluck('id');
        $earning_title = $earnings->pluck('title');
        $earning_value = $earnings->pluck('value');

        // Dados para gráfico de ganhos x despesas
        $totalExpenses = $expenses->sum('expense_value');
        $totalEarnings = $earnings->sum('value');
        $balance = $totalEarnings - $totalExpenses;

        // Dados para gráfico de linha (últimos 12 meses)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthExpenses = Expense::where('user_id', $user->id)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('expense_value');
            
            $monthEarnings = Earning::where('user_id', $user->id)
                ->whereYear('received_at', $date->year)
                ->whereMonth('received_at', $date->month)
                ->sum('value');

            $monthlyData[] = [
                'month' => $date->format('M/Y'),
                'expenses' => $monthExpenses,
                'earnings' => $monthEarnings
            ];
        }

        // Anos disponíveis para filtro
        $availableYears = collect();
        $expenseYears = Expense::where('user_id', $user->id)->distinct()->pluck('created_at')->map(function($date) {
            return Carbon::parse($date)->year;
        });
        $earningYears = Earning::where('user_id', $user->id)->distinct()->pluck('received_at')->map(function($date) {
            return Carbon::parse($date)->year;
        });
        $availableYears = $expenseYears->merge($earningYears)->unique()->sort();

        return view('dashboard', compact(
            'goal_title', 'goal_progress', 'goal_ids',
            'expense_ids', 'expense_name', 'expense_value', 'expense_payment_date', 'expense_status',
            'earning_ids', 'earning_title', 'earning_value',
            'totalExpenses', 'totalEarnings', 'balance', 'monthlyData',
            'selectedYear', 'selectedMonth', 'availableYears', 'user'
        ));
    }
}
