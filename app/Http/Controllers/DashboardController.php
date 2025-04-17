<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        // Gráfico de Progresso das Metas
        $goals = Goal::where('user_id', $user->id)->get();

        // pegar os ids das goals
        $goal_ids = Goal::pluck('id');

        $goal_title = $goals->pluck('goal_title');
        $goal_progress = $goals->map(function ($goal) {
            return $goal->target_value > 0 ? ($goal->valor_atual / $goal->target_value * 100) : 0;
        });

        // Gráfico de Gastos
        $gastos = Gasto::where('id_user', $user->id)->get();
        $gastos_ids = $gastos->pluck('id');
        $gastos_titulos = $gastos->pluck('descricao');
        $gastos_valores = $gastos->pluck('valor');
        $gastos_necessarios = $gastos->pluck('necessario'); // Assume que "tipo" pode ser 'necessario' ou 'nao_necessario'

        return view('dashboard', compact(
            'goal_title', 'goal_progress', 'goal_ids',
            'gastos_titulos', 'gastos_valores', 'gastos_necessarios', 'gastos_ids'
        ));
    }
}
