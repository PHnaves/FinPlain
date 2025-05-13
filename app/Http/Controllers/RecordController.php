<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    /**
     *  Pagina de gerar relatorios
     */
    public function index()
    {
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');
        return view('records.index', compact('expense_categories'));
    }

    /**
     * Gera o relatorio em pdf com os filtros escolhidos
     */
    public function generatePdf(Request $request)
    {
        $query = Expense::where('user_id', Auth::id());

        // Filtro categoria
        if ($request->filled('expense_category')){
            $query->where('expense_category', $request->expense_category);
        }

        // Filtro recorrencia
        if($request->filled('recurrence')){
            $query->where('recurrence', $request->recurrence);
        }

        // Filtro data de vencimento
        if ($request->filled('due_date')) {
            $query->where('due_date', $request->due_date);
        }

        // Filtro data de pagamento
        if ($request->filled('payment_date')) {
            $query->where('payment_date', $request->payment_date);
        }

        $expenses = $query->get();
        $total = $expenses->sum('expense_value');

        // Cria o PDF
        $pdf = Pdf::loadView('pdf.record', [
            'expenses' => $expenses,
            'total' => $total,
            'due_date' => $request->filled('due_date') ? Carbon::parse($request->due_date)->format('d/m/Y') : 'Data de Vancimento',
            'payment_date' => $request->filled('payment_date') ? Carbon::parse($request->payment_date)->format('d/m/Y') : 'Data De Pagamento'
        ]);

        // Baixar o PDF
        return $pdf->download('record.pdf');
    }

    /**
     * Filtra os gastos
     */
    public function filterExpenses(Request $request)
    {
        $query = Expense::where('user_id', Auth::id());

        if ($request->filled('expense_category')){
            $query->where('expense_category', $request->expense_category);
        }

        if($request->filled('recurrence')){
            $query->where('recurrence', $request->recurrence);
        }

        if ($request->filled('due_date')) {
            $query->where('due_date', $request->due_date);
        }

        if ($request->filled('payment_date')) {
            $query->where('payment_date', $request->payment_date);
        }

        $expenses = $query->get();
        $total = $expenses->sum('expense_value');
        $expense_categories = Expense::where('user_id', Auth::id())->distinct()->pluck('expense_category');

        return view('records.index', compact('expenses', 'total', 'expense_categories'));
    }
}
