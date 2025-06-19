<?php

namespace App\Http\Controllers;

use App\Http\Requests\EarningRequests\EarningStoreRequest;
use App\Http\Requests\EarningRequests\EarningUpdateRequest;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    public function index()
    {
        $earnings = Auth::user()->earnings()->latest()->get();
        return view('ganhos.index', compact('earnings'));
    }

    public function create()
    {
        return view('ganhos.create');
    }

    public function store(EarningStoreRequest $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'value' => 'required|numeric|min:0',
            'recurrence' => 'required|string',
            'received_at' => 'required|date',
        ]);
        $data['user_id'] = Auth::id();
        Earning::create($data);
        // Atualizar a renda atual do usuário (rent)
        $user = Auth::user();
        $user->rent = $user->rent + $data['value'];
        $user->save();
        return redirect()->route('ganhos.index')->with('success', 'Ganho cadastrado com sucesso!');
    }

    public function show(Earning $earning)
    {
        return view('ganhos.show', compact('earning'));
    }

    public function edit(Earning $earning)
    {
        // Verifica se o ganho pertence ao usuário atual
        if ($earning->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar este ganho.');
        }
        return view('ganhos.edit', compact('earning'));
    }

    public function update(EarningUpdateRequest $request, Earning $earning)
    {
        // Verifica se o ganho pertence ao usuário atual
        if ($earning->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para atualizar este ganho.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'value' => 'required|numeric|min:0',
            'recurrence' => 'required|string',
            'received_at' => 'required|date',
        ]);
        // Atualizar a renda do usuário (ajuste pela diferença de valor)
        $user = Auth::user();
        $user->monthly_income = $user->monthly_income - $earning->value + $data['value'];
        $user->save();
        $earning->update($data);
        return redirect()->route('ganhos.index')->with('success', 'Ganho atualizado com sucesso!');
    }

    public function destroy(Request $request, Earning $earning)
    {
        // Verifica se o ganho pertence ao usuário atual
        if ($earning->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir este ganho.');
        }
        // Perguntar ao usuário se deseja subtrair o valor do ganho da renda atual
        if ($request->has('subtrair_renda') && $request->input('subtrair_renda') == 'sim') {
            $user = Auth::user();
            $user->rent = $user->rent - $earning->value;
            $user->save();
        }
        $earning->delete();
        return redirect()->route('ganhos.index')->with('success', 'Ganho removido com sucesso!');
    }
} 