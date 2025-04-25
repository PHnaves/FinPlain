<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\GastoExcedido;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega apenas os gastos do usuário logado
        $gastos = Gasto::where('id_user', Auth::id())->get();
        return view('gastos.index', compact('gastos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:150',
            'valor' => 'required|numeric|min:0',
            'necessario' => 'required|in:sim,nao',
        ]);
    
    
        // Criando o gasto e armazenando na variável
        $gasto = Gasto::create([
            'id_user' => Auth::id(),
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'necessario' => $request->necessario,
        ]);
    
        return redirect()->route('gastos.index');
    }

    public function show(Gasto $gasto)
    {
        return view('gastos.show', compact('gasto'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gasto $gasto)
    {
        return view('gastos.edit', compact('gasto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'descricao' => 'required|string|max:150',
            'valor' => 'required|numeric|min:0',
            'necessario' => 'required|in:sim,nao',
        ]);

        $data = $request->only(['descricao', 'valor', 'necessario']);
        $gasto->update($data);
        return redirect()->route('gastos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gasto $gasto)
    {
        $gasto->delete();
        return redirect()->route('gastos.index');
    }
}
