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
    public function depositGoal(DepositStoreRequest $request, Goal $goal)
    {
        $user = Auth::user();

        // Validando o depósito
        $depositValue = $request->validated()['deposit_value'];

        // Verifica se o usuário tem saldo suficiente
        if ($user->rent < $depositValue) {
            return redirect()->back()->with('error', 'Saldo insuficiente para fazer esse depósito.');
        }

        // Verifica se o valor é positivo
        if ($depositValue <= 0) {
            return redirect()->back()->with('error', 'O valor do depósito deve ser maior que zero.');
        }

        // Cria o depósito
        DepositGoal::create([
            'goal_id' => $goal->id,
            'deposit_value' => $depositValue,
        ]);

        // Atualiza o valor atual da meta
        Goal::where('id', $goal->id)->update([
            'current_value' => $goal->current_value + $depositValue
        ]);

        // Diminui o saldo do usuário
        User::where('id', $user->id)->update([
            'rent' => $user->rent - $depositValue
        ]);

        return redirect()->back()->with('success', 'Depósito realizado com sucesso!');
    }

    public function payExpense($expense)
    {
        $expense = Expense::findOrFail($expense);
        $user = Auth::user();

        // Verifica se o usuário tem saldo suficiente
        if ($user->rent < $expense->expense_value) {
            return redirect()->back()->with('error', 'Saldo insuficiente para pagar essa despesa.');
        }

        // Diminui a quantidade de parcelas
        if ($expense->installments > 1) {
            $expense->installments -= 1;
        } else {
            // Última parcela
            $expense->installments = 0;
            $expense->payment_date = now();
        }

        // Atualiza a despesa
        Expense::where('id', $expense->id)->update([
            'installments' => $expense->installments,
            'payment_date' => $expense->payment_date
        ]);

        // Diminui o saldo do usuário
        User::where('id', $user->id)->update([
            'rent' => $user->rent - $expense->expense_value
        ]);

        return redirect()->back()->with('success', 'Despesa paga com sucesso!');
    }
}
