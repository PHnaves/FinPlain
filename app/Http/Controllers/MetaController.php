<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metas = Meta::all();
        return view('metas.index', compact('metas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor_final' => 'required|numeric|min:0',
            'valor_atual' => 'nullable|numeric|min:0',
            'periodicidade' => 'required|in:semanal,mensal',
            'valor_periodico' => 'required|numeric|min:0',
            'status' => 'required|in:andamento,concluída,cancelada',
        ]);

        // Criação da meta associada ao usuário autenticado
        Meta::create([
            'id_user' => Auth::id(), // Garante que a meta seja associada ao usuário correto
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'valor_final' => $request->valor_final,
            'valor_atual' => $request->valor_atual ?? 0, // Garante um valor padrão
            'periodicidade' => $request->periodicidade,
            'valor_periodico' => $request->valor_periodico,
            'status' => $request->status,
        ]);

        return redirect()->route('metas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meta $meta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meta $meta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meta $meta)
    {
        //
    }
}
