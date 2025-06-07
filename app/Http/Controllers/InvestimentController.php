<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investiment;
use Illuminate\Support\Facades\Auth;

class InvestimentController extends Controller
{
    public function index()
    {
        // Obtém o perfil do usuário logado
        $userProfile = Auth::user()->type_user;
        $user_rent = Auth::user()->rent;

        // Busca os investimentos recomendados para o perfil do usuário
        $investiments = Investiment::where('recommended_profile', $userProfile)->get();

        return view('investimentos', compact('investiments', 'user_rent'));
    }
}
