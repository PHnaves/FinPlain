<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function gerarPDF(Request $request)
    {
        $query = Gasto::query();

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $dataInicio = Carbon::parse($request->data_inicio)->startOfDay();
            $dataFim = Carbon::parse($request->data_fim)->endOfDay();
            $query->whereBetween('created_at', [$dataInicio, $dataFim]);
        }

        if ($request->filled('tipo')) {
            $query->where('necessario', $request->tipo === '1' ? 'sim' : 'nao');
        }

        $gastos = $query->get();
        $total = $gastos->sum('valor');
        
        $pdf = Pdf::loadView('pdf.relatorio', [
            'gastos' => $gastos,
            'total' => $total,
            'data_inicio' => $request->filled('data_inicio') ? Carbon::parse($request->data_inicio)->format('d/m/Y') : 'Início',
            'data_fim' => $request->filled('data_fim') ? Carbon::parse($request->data_fim)->format('d/m/Y') : 'Fim'
        ]);
        
        return $pdf->download('relatorio.pdf');
    }

    public function filtarGastos(Request $request)
    {
        $query = Gasto::query();

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
        }

        if ($request->filled('tipo')) {
            $query->where('necessario', $request->tipo === 'entrada' ? 'sim' : 'nao');
        }

        $gastos = $query->get();
        $total = $gastos->sum('valor');

        return view('relatorios.index', compact('gastos', 'total'));
    }
}