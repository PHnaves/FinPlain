<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestimentoController extends Controller
{
    public function index()
    {
        // verificar qual é o tipo de usuario 

        return view('investimentos');
    }
}
