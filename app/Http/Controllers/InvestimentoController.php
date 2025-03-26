<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investimento;
use Illuminate\Support\Facades\Auth;

class InvestimentoController extends Controller
{
    public function index()
    {
        // Obtém o perfil do usuário logado
        $perfilUsuario = Auth::user()->typeUser;

        // Busca os investimentos recomendados para o perfil do usuário
        $investimentos = Investimento::where('perfil_recomendado', $perfilUsuario)->get();

        return view('investimentos', compact('investimentos'));
    }
}
