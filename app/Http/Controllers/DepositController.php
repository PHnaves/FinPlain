<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositStoreRequest;
use App\Models\DepositGoal;
use App\Models\Expense;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function depositar(DepositStoreRequest $request, Goal $goal)
    {
        $user = Auth::user();

        $depositValue = $request->validated()['deposit_value'];

        // 1. Verifica se o usuário tem saldo suficiente
        if ($user->rent < $depositValue) {
            return redirect()->back()->with('error', 'Saldo insuficiente para fazer esse depósito.');
        }

        // 2. Verifica se o valor é positivo
        if ($depositValue <= 0) {
            return redirect()->back()->with('error', 'O valor do depósito deve ser maior que zero.');
        }

        // 3. Cria o depósito
        DepositGoal::create([
            'goal_id' => $goal->id,
            'deposit_value' => $depositValue,
        ]);

        // 4. Atualiza o valor atual da meta
        Goal::where('id', $goal->id)->update([
            'current_value' => $goal->current_value + $depositValue
        ]);

        // 5. Diminui o saldo do usuário
        User::where('id', $user->id)->update([
            'rent' => $user->rent - $depositValue
        ]);

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

        Expense::where('id', $expense->id)->update([
            'installments' => $expense->installments,
            'payment_date' => $expense->payment_date
        ]);

        // 4. Diminui o saldo do usuário
        User::where('id', $user->id)->update([
            'rent' => $user->rent - $expense->expense_value
        ]);

        return redirect()->back()->with('success', 'Despesa paga com sucesso!');
    }
}
