<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequests\ExpenseDeleteRequest;
use App\Http\Requests\ExpenseRequests\ExpenseEditRequest;
use App\Http\Requests\ExpenseRequests\ExpenseShowRequest;
use App\Http\Requests\ExpenseRequests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseRequests\ExpenseUpdateRequest;
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
    public function store(ExpenseStoreRequest $request)
    {

        $validated = $request->validated();

        // Define o valor padrão para parcelas, caso não venha preenchido
        $validated['installments'] = $validated['installments'] ?? 1;
        $validated['user_id'] = Auth::id();

        Expense::create($validated);

        return redirect()->route('despesas.index')->with('success', 'Despesa cadastrada com sucesso!');
    }

    /**
     * Mostrar uma despesa específica.
     */
    public function show(Request $request, Expense $expense)
    {
        return view('despesas.show', compact('expense'));
    }

    /**
     * Editar uma despesa.
     */
    public function edit(Request $request, Expense $expense)
    {
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        return view('despesas.edit', compact('expense', 'expense_categories'));
    }

    /**
     * Atualizar despesa.
     */
    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {

        $validated = $request->validated();

        $validated['installments'] = $validated['installments'] ?? 1;

        $expense->update($validated);

        return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    /**
     * Remover despesa.
     */
    public function destroy(Request $request, Expense $expense)
    {
        $expense->delete();

        return redirect()->route('despesas.index')->with('success', 'Despesa removida com sucesso!');
    }
}
