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
            'status' => 'in:andamento,concluída,cancelada',
        ]);

        // Dados do formulário
        $data = $request->only([
            'titulo', 
            'descricao', 
            'valor_final', 
            'valor_atual', 
            'periodicidade', 
            'valor_periodico', 
            'status'
        ]);

        // Garante que o valor_atual tenha um valor padrão de 0 caso não seja fornecido
        $data['valor_atual'] = $data['valor_atual'] ?? 0;

        // Criando a meta associada ao usuário autenticado
        Meta::create([
            'id_user' => Auth::id(), // Associando ao usuário autenticado
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'],
            'valor_final' => $data['valor_final'],
            'valor_atual' => $data['valor_atual'], // Usando o valor atualizado
            'periodicidade' => $data['periodicidade'],
            'valor_periodico' => $data['valor_periodico'],
            'status' => $data['status'] ?? 'andamento', // Default status se não informado
        ]);

        return redirect()->route('metas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meta $meta)
    {
        return view('metas.show', compact('meta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meta $meta)
    {
        return view('metas.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meta $meta)
    {
        // Validação dos campos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor_final' => 'required|numeric|min:0',
            'valor_atual' => 'nullable|numeric|min:0',
            'periodicidade' => 'required|in:semanal,mensal',
            'valor_periodico' => 'required|numeric|min:0',
            'status' => 'in:andamento,concluída,cancelada',
        ]);
        
        // Atualização dos dados da meta
        $data = $request->only(['titulo', 'descricao', 'valor_final', 'valor_atual', 'periodicidade', 'valor_periodico', 'status']);

        $meta->update($data);

        return redirect()->route('metas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meta $meta)
    {
        $meta->delete();
        return redirect()->route('metas.index');
    }
}
