<?php

namespace App\Http\Controllers;

use App\Mail\LembreteEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class LembreteController extends Controller
{
    public function store(Request $request) {

        // verificar se o usuario esta logado/autenticado
        $user = Auth::user();

        if (!$user) {
            Mail::to(User::first()->email)->send(new LembreteEmail());
        }

    }
}
