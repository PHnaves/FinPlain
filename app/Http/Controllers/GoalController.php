<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalRequests\GoalDeleteRequest;
use App\Http\Requests\GoalRequests\GoalEditRequest;
use App\Http\Requests\GoalRequests\GoalShowRequest;
use App\Http\Requests\GoalRequests\GoalStoreRequest;
use App\Http\Requests\GoalRequests\GoalUpdateRequest;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//para verificar se o usuario esta logado/autenticado
use Carbon\Carbon;// para manipular datas

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = Goal::all();
        return view('metas.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $goal_categories = Goal::distinct()->pluck('goal_category');

        return view('metas.create', compact('goal_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoalStoreRequest $request)
    {
        // Validação dos campos
        $validated = $request->validated();

        // Garante que o valor_atual tenha um valor padrão de 0 caso não seja fornecido
        $validated['target_value'] = $validated['target_value'] ?? 0;
        $validated['user_id'] = Auth::id();

        // Criando a goal associada ao usuário autenticado
        Goal::create($validated);

        return redirect()->route('metas.index')->with('success', 'Meta cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        // Calcula quantos depósitos ainda são necessários para concluir a goal
        if ($goal->target_value >= $goal->current_value) {
            $deposits_number = 0;
            $conclusion_date = Carbon::now()->format('d/m/Y');
            $message = "Sua Meta já foi atingida! Parabens, continue assim.";
        } else {
            $deposits_number = ceil(($goal->target_value - $goal->current_value) / $goal->recurring_value);
    
            // Define o intervalo de dias baseado na periodicidade
            $intervalo = match ($goal->frequency) {
                'semanal' => 7,
                'mensal' => 30,
                default => null
            };
    
            if (!$intervalo) {
                return redirect()->route('metas.index')->with('error', 'Periodicidade inválida.');
            }
    
            // Calcula a data estimada para conclusão
            $conclusion_date = Carbon::now()->addDays($deposits_number * $intervalo)->format('d/m/Y');
            $message = "Você atingirá sua goal em aproximadamente $deposits_number depósitos. Continue firme e forte!";
        }
    
        return view('metas.show', compact('goal', 'deposits_number', 'conclusion_date', 'message'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Goal $goal)
    {
        // prgar somente a categoria das metas
        $goal_categories = Goal::distinct()->pluck('goal_category');

        return view('metas.edit', compact('goal', 'goal_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoalUpdateRequest $request, Goal $goal)
    {
        // Validação dos campos
        $validated = $request->validated();
        
        $validated['target_value'] = $validated['target_value'] ?? 0;

        // Atualização dos dados da meta
        $goal->update($validated);

        return redirect()->route('metas.index')->with('success', 'Meta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Goal $goal)
    {
        $goal->delete();

        return redirect()->route('metas.index')->with('success', 'Meta removida com sucesso!');
    }
}
