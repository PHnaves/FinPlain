<?php

namespace App\Http\Controllers;

use App\Models\DepositGoal;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function depositar(Request $request, $goal)
    {
        $goal = Goal::findOrFail($goal);
        $user = Auth::user();

        $depositValue = $request->input('deposit_value');

        // 1. Verifica se o usuário tem saldo suficiente
        if ($user->rent < $depositValue) {
            return redirect()->back()->with('error', 'Saldo insuficiente para fazer esse depósito.');
        }

        // 2. Cria o depósito
        DepositGoal::create([
            'goal_id' => $goal->id,
            'deposit_value' => $depositValue,
        ]);

        // 3. Atualiza o valor atual da meta
        $goal->current_value += $depositValue;
        $goal->save();

        // 4. Diminui o saldo do usuário
        $user->rent -= $depositValue;
        $user->save();

        return redirect()->back()->with('success', 'Depósito realizado com sucesso!');
    }

}
