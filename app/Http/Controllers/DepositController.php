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
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para realizar depósitos nesta meta.');
        }

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

        // Verifica se a meta já está concluída
        if ($goal->status === 'concluída') {
            return redirect()->back()->with('error', 'Não é possível fazer depósitos em uma meta concluída.');
        }

        // Verifica se o depósito não ultrapassa o valor final da meta
        if ($goal->current_value + $depositValue > $goal->target_value) {
            return redirect()->back()->with('error', 'O valor do depósito ultrapassa o valor final da meta.');
        }

        // Cria o depósito
        DepositGoal::create([
            'goal_id' => $goal->id,
            'deposit_value' => $depositValue,
        ]);

        // Atualiza o valor atual da meta
        $newCurrentValue = $goal->current_value + $depositValue;
        $status = $newCurrentValue >= $goal->target_value ? 'concluída' : $goal->status;

        Goal::where('id', $goal->id)->update([
            'current_value' => $newCurrentValue,
            'status' => $status
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
        
        // Verifica se a despesa pertence ao usuário atual
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para pagar esta despesa.');
        }

        $user = Auth::user();

        // Verifica se o usuário tem saldo suficiente
        if ($user->rent < $expense->expense_value) {
            return redirect()->back()->with('error', 'Saldo insuficiente para pagar essa despesa.');
        }

        // Se a despesa já tem data de pagamento, não permite pagar novamente
        if ($expense->payment_date) {
            return redirect()->back()->with('error', 'Esta despesa já foi paga.');
        }

        // Se a despesa tem parcelas
        if ($expense->installments > 0) {
            // Diminui a quantidade de parcelas
            $expense->installments -= 1;
            
            // Se for a última parcela, marca como pago
            if ($expense->installments === 0) {
                $expense->payment_date = now();
            }
        } else {
            // Se não tem parcelas, marca como pago
            $expense->payment_date = now();
        }

        // Atualiza a despesa
        $expense->save();

        // Diminui o saldo do usuário
        User::where('id', $user->id)->update([
            'rent' => $user->rent - $expense->expense_value
        ]);

        return redirect()->back()->with('success', 'Despesa paga com sucesso!');
    }
}
