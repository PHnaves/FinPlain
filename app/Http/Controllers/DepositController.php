<?php

namespace App\Http\Controllers;

use App\Models\DepositGoal;
use App\Models\Expense;
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

    public function pagarDespesa($expense)
    {
        $expense = Expense::findOrFail($expense);
        $user = Auth::user();

        // 2. Verifica se o usuário tem saldo suficiente
        if ($user->rent < $expense->expense_value) {
            return redirect()->back()->with('error', 'Saldo insuficiente para pagar essa despesa.');
        }

        // 3. Diminui a quantidade de parcelas
        if ($expense->installments > 1) {
            $expense->installments -= 1;
        } else {
            // Última parcela
            $expense->installments = 0;
            $expense->payment_date = now();
        }

        $expense->save();

        // 4. Diminui o saldo do usuário
        $user->rent -= $expense->expense_value;
        $user->save();

        return redirect()->back()->with('success', 'Despesa paga com sucesso!');
    }

}
