<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseRequests\ExpenseUpdateRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Listar todas as despesas.
     */
    public function index(Request $request)
    {
        $currentMonth = $request->get('month', now()->format('m'));
        $currentYear = $request->get('year', now()->format('Y'));
        $recurrence = $request->get('recurrence');

        $query = Expense::where('user_id', Auth::id());

        // Filtro por mês
        if ($currentMonth && $currentYear) {
            $query->whereMonth('due_date', $currentMonth)
                  ->whereYear('due_date', $currentYear);
        }

        // Filtro por recorrência
        if ($recurrence) {
            if ($recurrence === 'mensal') {
                $query->where('recurrence', 'mensal');
            } elseif ($recurrence === 'única') {
                $query->where(function($q) {
                    $q->where('recurrence', 'a vista')
                      ->orWhereNull('recurrence')
                      ->orWhere('installments', 0);
                });
            }
        }

        $expenses = $query->orderBy('due_date', 'desc')->get();
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        // Dados para os gráficos
        // 1. Distribuição por categoria
        $categoryData = $expenses->groupBy('expense_category')
            ->map(function ($items) {
                return $items->sum('expense_value');
            });

        // 2. Tendência mensal (últimos 6 meses)
        $monthlyData = Expense::where('user_id', Auth::id())
            ->where('due_date', '>=', now()->subMonths(6))
            ->get()
            ->groupBy(function ($expense) {
                return Carbon::parse($expense->due_date)->format('Y-m');
            })
            ->map(function ($items) {
                return $items->sum('expense_value');
            });

        // 3. Status de pagamento
        $paymentStatus = $expenses->groupBy(function ($expense) {
            return $expense->payment_date ? 'Pago' : 'Pendente';
        })->map(function ($items) {
            return $items->sum('expense_value');
        });

        // 4. Métricas principais
        $metrics = [
            'total_expenses' => $expenses->sum('expense_value'),
            'paid_expenses' => $expenses->whereNotNull('payment_date')->sum('expense_value'),
            'pending_expenses' => $expenses->whereNull('payment_date')->sum('expense_value'),
            'average_expense' => $expenses->avg('expense_value'),
            'total_count' => $expenses->count(),
            'paid_count' => $expenses->whereNotNull('payment_date')->count(),
            'pending_count' => $expenses->whereNull('payment_date')->count(),
        ];

        return view('despesas.index', compact(
            'expenses', 
            'expense_categories', 
            'recurrence', 
            'currentMonth', 
            'currentYear',
            'categoryData',
            'monthlyData',
            'paymentStatus',
            'metrics'
        ));
    }

    /**
     * Mostrar o formulário para criar uma nova despesa.
     */
    public function create()
    {
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');
        return view('despesas.create', compact('expense_categories'));
    }

    /**
     * Salvar uma nova despesa.
     */
    public function store(ExpenseStoreRequest $request)
    {
        $validated = $request->validated();

        // Se a despesa for à vista, não tem parcelas
        if ($validated['recurrence'] === 'a vista') {
            $validated['installments'] = 0;
        } else {
            // Define o valor padrão para parcelas, caso não venha preenchido
            $validated['installments'] = $validated['installments'] ?? 1;
        }

        $validated['user_id'] = Auth::id();

        Expense::create($validated);

        return redirect()->route('despesas.index')->with('success', 'Despesa cadastrada com sucesso!');
    }

    /**
     * Mostrar uma despesa específica.
     */
    public function show(Request $request, Expense $expense)
    {
        // Verifica se a despesa pertence ao usuário atual
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar esta despesa.');
        }

        return view('despesas.show', compact('expense'));
    }

    /**
     * Mostrar o formulário para editar uma despesa.
     */
    public function edit(Request $request, Expense $expense)
    {
        // Verifica se a despesa pertence ao usuário atual
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar esta despesa.');
        }

        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        return view('despesas.edit', compact('expense', 'expense_categories'));
    }

    /**
     * Atualizar despesa.
     */
    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        // Verifica se a despesa pertence ao usuário atual
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para atualizar esta despesa.');
        }

        $validated = $request->validated();

        // Se a despesa for à vista, não tem parcelas
        if ($validated['recurrence'] === 'a vista') {
            $validated['installments'] = 0;
        } else {
            // Se a despesa tem data de pagamento, não permite alterar as parcelas
            if (!empty($validated['payment_date'])) {
                unset($validated['installments']);
            } else {
                // Se a data de pagamento foi removida, permite alterar as parcelas
                $validated['installments'] = $validated['installments'] ?? 1;
            }
        }

        $expense->update($validated);

        return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    /**
     * Remover despesa.
     */
    public function destroy(Request $request, Expense $expense)
    {
        // Verifica se a despesa pertence ao usuário atual
        if ($expense->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir esta despesa.');
        }

        $expense->delete();

        return redirect()->route('despesas.index')->with('success', 'Despesa removida com sucesso!');
    }
}
