<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = Despesa::all();
        return view('despesa.index', compact('despesas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'recorrente' => 'boolean',
            'data_vencimento' => 'nullable|date',
        ]);

        // Convertendo sim e nao os valores do select, para valores booleanos
        $recorrente = $request->recorrente == "1" ? true : false;

        Despesa::create([
            'id_user' => Auth::id(),
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'recorrente' => $recorrente,
            'data_vencimento' => $request->data_vencimento,
        ]);

        return redirect()->route('despesa.index')->with('success', 'Despesa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Despesa $despesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Despesa $despesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Despesa $despesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Despesa $despesa)
    {
        //
    }
}
