<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meta;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        // Gráfico de Progresso das Metas
        $metas = Meta::where('id_user', $user->id)->get();

        // pegar os ids das metas
        $metas_ids = Meta::pluck('id');          // Pega os IDs das metas

        $metas_titulos = $metas->pluck('titulo');
        $metas_progresso = $metas->map(function ($meta) {
            return $meta->valor_final > 0 ? ($meta->valor_atual / $meta->valor_final * 100) : 0;
        });

        // Gráfico de Gastos
        $gastos = Gasto::where('id_user', $user->id)->get();
        $gastos_ids = $gastos->pluck('id');
        $gastos_titulos = $gastos->pluck('descricao');
        $gastos_valores = $gastos->pluck('valor');
        $gastos_necessarios = $gastos->pluck('necessario'); // Assume que "tipo" pode ser 'necessario' ou 'nao_necessario'

        return view('dashboard', compact(
            'metas_titulos', 'metas_progresso', 'metas_ids',
            'gastos_titulos', 'gastos_valores', 'gastos_necessarios', 'gastos_ids'
        ));
    }
}
