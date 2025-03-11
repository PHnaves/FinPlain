<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Despesa;
use App\Models\Meta;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        // Cálculo do total de gastos diretamente no banco
        $total_gastos = Despesa::where('id_user', $user->id)->sum('valor');

        // Saldo disponível (considerando metas)
        $saldo_disponivel = $user->saldo - $total_gastos;

        // Gráfico de Gastos por Categoria
        $gastos_por_categoria = Despesa::where('id_user', $user->id)
            ->selectRaw('tipo as categoria, SUM(valor) as total')
            ->groupBy('tipo')
            ->get();

        $categorias = $gastos_por_categoria->pluck('categoria');
        $valores = $gastos_por_categoria->pluck('total');

        // Gráfico de Progresso das Metas
        $metas = Meta::where('id_user', $user->id)->get();

        // pegar os ids das metas
        $metas_ids = Meta::pluck('id');          // Pega os IDs das metas

        $metas_titulos = $metas->pluck('titulo');
        $metas_progresso = $metas->map(function ($meta) {
            return $meta->valor_final > 0 ? ($meta->valor_atual / $meta->valor_final * 100) : 0;
        });

        return view('dashboard', compact(
            'total_gastos', 'saldo_disponivel', 
            'categorias', 'valores', 
            'metas_titulos', 'metas_progresso',
            'metas_ids'
        ));
    }
}
