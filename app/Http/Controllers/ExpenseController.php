<?php

namespace App\Http\Controllers;

use App\Events\ExpenseLimit;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Listar todas as despesas.
     */
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())->get();
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        return view('despesas.index', compact('expenses', 'expense_categories'));
    }

    /**
     * Salvar uma nova despesa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_name' => 'required|string|max:100',
            'expense_description' => 'required|string',
            'expense_category' => 'required|string|max:100',
            'expense_value' => 'required|numeric|min:0',
            'recurrence' => 'required|in:a vista,semanal,quinzenal,mensal,trimestral,semestral,anual',
            'installments' => 'nullable|integer|min:1',
            'due_date' => 'required|date',
            'payment_date' => 'nullable|date',
        ]);

        // Define o valor padrão para parcelas, caso não venha preenchido
        $validated['installments'] = $validated['installments'] ?? 1;
        $validated['user_id'] = Auth::id();

        $expense = Expense::create($validated);

        $user = Auth::user();
        $rent = $user->rent;
        $limit = $rent * 0.5;

        if ($expense->expense_value > $limit) {
            event(new ExpenseLimit($user, $expense));
        }

        return redirect()->route('despesas.index')->with('success', 'Despesa cadastrada com sucesso!');
    }

    /**
     * Mostrar uma despesa específica.
     */
    public function show(Expense $expense)
    {
        return view('despesas.show', compact('expense'));
    }

    /**
     * Editar uma despesa.
     */
    public function edit(Expense $expense)
    {
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        return view('despesas.edit', compact('expense', 'expense_categories'));
    }

    /**
     * Atualizar despesa.
     */
    public function update(Request $request, Expense $expense)
    {

        $validated = $request->validate([
            'expense_name' => 'required|string|max:100',
            'expense_description' => 'required|string',
            'expense_category' => 'required|string|max:100',
            'expense_value' => 'required|numeric|min:0',
            'recurrence' => 'required|in:a vista,semanal,quinzenal,mensal,trimestral,semestral,anual',
            'installments' => 'nullable|integer|min:1',
            'due_date' => 'required|date',
            'payment_date' => 'nullable|date',
        ]);

        $validated['installments'] = $validated['installments'] ?? 1;

        $expense->update($validated);

        return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    /**
     * Remover despesa.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('despesas.index')->with('success', 'Despesa removida com sucesso!');
    }
}
