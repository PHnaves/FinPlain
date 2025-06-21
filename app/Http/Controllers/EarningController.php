<?php

namespace App\Http\Controllers;

use App\Http\Requests\EarningRequests\EarningStoreRequest;
use App\Http\Requests\EarningRequests\EarningUpdateRequest;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    public function index(Request $request)
    {
        //Renda do usuario
        $user_rent = Auth::user()->rent;

        $query = Auth::user()->earnings()->latest();
        // Filtros
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('recurrence')) {
            $query->where('recurrence', $request->recurrence);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('received_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('received_at', '<=', $request->date_to);
        }
        $earnings = $query->paginate(10)->withQueryString();
        // Dados para gráfico de ganhos por mês
        $earningsByMonth = Auth::user()->earnings()
            ->selectRaw('MONTH(received_at) as month, YEAR(received_at) as year, SUM(value) as total')
            ->groupByRaw('YEAR(received_at), MONTH(received_at)')
            ->orderByRaw('YEAR(received_at) DESC, MONTH(received_at) DESC')
            ->get();
        // Dados para gráfico de recorrência
        $earningsByRecurrence = Auth::user()->earnings()
            ->selectRaw('recurrence, SUM(value) as total')
            ->groupBy('recurrence')
            ->get();
        // Recorrências distintas para o filtro
        $recurrences = Auth::user()->earnings()->select('recurrence')->distinct()->pluck('recurrence');
        return view('ganhos.index', compact('user_rent', 'earnings', 'earningsByMonth', 'earningsByRecurrence', 'recurrences'));
    }

    public function create()
    {
        return view('ganhos.create');
    }

    public function store(EarningStoreRequest $request)
    {
        $data = $request->validated();
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

        $data = $request->validated();
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