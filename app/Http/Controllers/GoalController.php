<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'goal_title' => 'required|string|max:255',
            'goal_description' => 'nullable|string',
            'goal_category' => 'required|string|max:100',
            'target_value' => 'nullable|numeric|min:0',
            'current_value' => 'nullable|numeric|min:0',
            'frequency' => 'required|in:semanal,mensal',
            'recurring_value' => 'required|numeric|min:0',
            'status' => 'in:andamento,concluída,cancelada',
            'end_date' => 'required|date',
        ]);

        // Dados do formulário
        $data = $request->only([
            'goal_title', 
            'goal_description', 
            'goal_category', 
            'target_value', 
            'current_value', 
            'frequency',
            'recurring_value', 
            'status',
            'end_date'
        ]);

        // Garante que o valor_atual tenha um valor padrão de 0 caso não seja fornecido
        $data['target_value'] = $data['target_value'] ?? 0;

        // Criando a goal associada ao usuário autenticado
        Goal::create([
            'user_id' => Auth::id(), // Associando ao usuário autenticado
            'goal_title' => $data['goal_title'],
            'goal_description' => $data['goal_description'],
            'goal_category' => $data['goal_category'],
            'target_value' => $data['target_value'],
            'current_value' => $data['current_value'],
            'frequency' => $data['frequency'],
            'recurring_value' => $data['recurring_value'],
            'status' => $data['status'] ?? 'andamento', // Default status se não informado
            'end_date' => $data['end_date'],
        ]);

        return redirect()->route('metas.index');
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
            $deposits_number = ceil(($goal->valor_final - $goal->valor_atual) / $goal->valor_periodico);
    
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
    public function edit(Goal $goal)
    {
        // prgar somente a categoria das metas
        $goal_categories = Goal::distinct()->pluck('goal_category');

        return view('metas.edit', compact('goal', 'goal_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        // Validação dos campos
        $request->validate([
            'goal_title' => 'required|string|max:255',
            'goal_description' => 'nullable|string',
            'goal_category' => 'required|string|max:100',
            'target_value' => 'nullable|numeric|min:0',
            'current_value' => 'nullable|numeric|min:0',
            'frequency' => 'required|in:semanal,mensal',
            'recurring_value' => 'required|numeric|min:0',
            'status' => 'in:andamento,concluída,cancelada',
            'end_date' => 'required|date',
        ]);
        
        // Atualização dos dados da meta
        $data = $request->only([
            'goal_title',
            'goal_description',
            'goal_category',
            'target_value',
            'current_value',
            'frequency',
            'recurring_value',
            'status',
            'end_date'
        ]);

        $goal->update($data);

        return redirect()->route('metas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('metas.index');
    }
}
