<?php

namespace App\Http\Controllers;

use App\Models\Renda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rendas = Renda::all();
        return view('renda.index', compact('rendas'));
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
            'valor' => 'required|numeric|min:0',
        ]);

        Renda::create([
            'id_user' => Auth::id(),
            'valor' => $request->valor,
        ]);

        return redirect()->route('renda.index')->with('success', 'Renda cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Renda $renda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Renda $renda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Renda $renda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renda $renda)
    {
        //
    }
}
