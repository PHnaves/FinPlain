<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function gerarPDF()
    {
        // Busca os gastos do banco de dados
        $gastos = Gasto::orderBy('created_at', 'desc')->get();
        
        // Calcula o total
        $total = $gastos->sum('valor');
        
        // Gera o PDF
        $pdf = Pdf::loadView('pdf.relatorio', [
            'gastos' => $gastos,
            'total' => $total
        ]);
        
        // Faz o download do PDF
        return $pdf->download('relatorio.pdf');
    }
}