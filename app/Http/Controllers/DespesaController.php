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
        return view('despesas.index', compact('despesas'));
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
    
        Despesa::create([
            'id_user' => Auth::id(),
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'recorrente' => $request->recorrente == "1",
            'data_vencimento' => $request->data_vencimento,
        ]);
    
        return redirect()->route('despesas.index')->with('success', 'Despesa cadastrada com sucesso!');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Despesa $despesa)
    {
        return view('despesas.show', compact('despesa'));
    }

    public function edit(Despesa $despesa)
    {
        return view('despesas.edit', compact('despesa'));
    }
    
    public function update(Request $request, Despesa $despesa)
    {
        $request->validate([
            'tipo' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'recorrente' => 'boolean',
            'data_vencimento' => 'nullable|date',
        ]);
    
        $data = $request->only(['tipo', 'valor', 'data_vencimento']);
        $data['recorrente'] = $request->recorrente == "1";
    
        $despesa->update($data);
    
        return redirect()->route('despesas.index')->with('success', 'Despesa atualizada com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return redirect()->route('despesas.index')->with('success', 'Despesa removida com sucesso!');
    }
    
}
