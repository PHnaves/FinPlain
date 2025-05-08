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
     * Listar todas as metas.
     */
    public function index(Request $request)
    {
        $query = Goal::where('user_id', auth()->id());

        // Filtro por status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $goals = $query->get();
        return view('metas.index', compact('goals'));
    }

    /**
     * Mostrar o formulário para criar uma nova meta.
     */
    public function create()
    {
        $goal_categories = Goal::where('user_id', auth()->id())->distinct()->pluck('goal_category');
        return view('metas.create', compact('goal_categories'));
    }

    /**
     * Salvar uma nova meta
     */
    public function store(GoalStoreRequest $request)
    {
        $data = $request->validated();
        
        // Calcula o valor por período
        $data['recurring_value'] = $this->calculateRecurringValue(
            $data['target_value'],
            $data['frequency'],
            $data['end_date']
        );

        // Verifica o status da meta
        if ($data['current_value'] >= $data['target_value']) {
            $data['status'] = 'concluída';
            $data['current_value'] = $data['target_value']; // Garante que não ultrapasse o valor final
        } else if (isset($data['status']) && $data['status'] === 'cancelada') {
            $data['status'] = 'cancelada';
        } else {
            $data['status'] = 'andamento';
        }

        // Adiciona o user_id do usuário autenticado
        $data['user_id'] = auth()->id();
        
        $goal = Goal::create($data);
        
        return redirect()->route('metas.show', $goal)
            ->with('success', 'Meta criada com sucesso!');
    }

    /**
     * Detalhes da meta
     */
    public function show(Goal $goal)
    {
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar esta meta.');
        }

        // Verifica se o valor atual atingiu ou ultrapassou o valor final
        if ($goal->current_value >= $goal->target_value && $goal->status !== 'concluída') {
            $goal->update([
                'status' => 'concluída',
                'current_value' => $goal->target_value // Garante que não ultrapasse o valor final
            ]);
        }

        // Calcula o número de depósitos restantes
        $remaining_value = $goal->target_value - $goal->current_value;
        $deposits_number = ceil($remaining_value / $goal->recurring_value);

        // Calcula a data estimada de conclusão
        $conclusion_date = null;
        if ($goal->status === 'andamento' && $goal->frequency && $goal->end_date) {
            $end_date = Carbon::parse($goal->end_date);
            $today = Carbon::now();
            
            if ($goal->frequency === 'semanal') {
                $conclusion_date = $today->copy()->addWeeks($deposits_number);
            } else {
                $conclusion_date = $today->copy()->addMonths($deposits_number);
            }
            
            // Se a data calculada for posterior à data final, usa a data final
            if ($conclusion_date->gt($end_date)) {
                $conclusion_date = $end_date;
            }
        }

        // Define a mensagem baseada no status da meta
        $message = match($goal->status) {
            'concluída' => 'Parabéns! Sua meta foi concluída com sucesso!',
            'cancelada' => 'Esta meta foi cancelada em ' . Carbon::parse($goal->updated_at)->format('d/m/Y'),
            default => 'Você atingirá sua meta em aproximadamente ' . $deposits_number . ' depósitos. Continue firme e forte!'
        };

        // Gera dados para o gráfico de progresso
        $progressData = collect();
        
        // Adiciona o ponto inicial (0)
        $progressData->push([
            'date' => Carbon::parse($goal->created_at)->format('d/m/Y'),
            'value' => 0
        ]);

        // Adiciona o ponto atual
        $progressData->push([
            'date' => Carbon::now()->format('d/m/Y'),
            'value' => $goal->current_value
        ]);

        return view('metas.show', compact('goal', 'deposits_number', 'conclusion_date', 'progressData', 'message'));
    }
    

    /**
     * Mostrar o formulário para editar uma meta.
     */
    public function edit(Request $request, Goal $goal)
    {
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar esta meta.');
        }

        $goal_categories = Goal::where('user_id', auth()->id())->distinct()->pluck('goal_category');
        return view('metas.edit', compact('goal', 'goal_categories'));
    }

    /**
     * Atualizar meta
     */
    public function update(GoalUpdateRequest $request, Goal $goal)
    {
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para atualizar esta meta.');
        }

        $data = $request->validated();
        
        // Calcula o valor por período
        $data['recurring_value'] = $this->calculateRecurringValue(
            $data['target_value'],
            $data['frequency'],
            $data['end_date']
        );

        // Verifica o status da meta
        if ($data['current_value'] >= $data['target_value']) {
            $data['status'] = 'concluída';
            $data['current_value'] = $data['target_value']; // Garante que não ultrapasse o valor final
        } else if (isset($data['status']) && $data['status'] === 'cancelada') {
            $data['status'] = 'cancelada';
        } else {
            $data['status'] = 'andamento';
        }
        
        $goal->update($data);
        
        return redirect()->route('metas.show', $goal)
            ->with('success', 'Meta atualizada com sucesso!');
    }

    /**
     * Remover meta
     */
    public function destroy(Request $request, Goal $goal)
    {
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para excluir esta meta.');
        }

        $goal->delete();
        return redirect()->route('metas.index')->with('success', 'Meta removida com sucesso!');
    }

    /**
     * Calcula o valor recorrente baseado na frequência e data final
     */
    private function calculateRecurringValue($targetValue, $frequency, $endDate)
    {
        $now = Carbon::now();
        $end = Carbon::parse($endDate);
        
        // Se a data final já passou, retorna o valor total
        if ($now->greaterThan($end)) {
            return $targetValue;
        }
        
        // Calcula o número de períodos baseado na frequência
        $periods = match ($frequency) {
            'semanal' => $now->diffInWeeks($end),
            'mensal' => $now->diffInMonths($end),
            default => 1
        };

        // Evita divisão por zero
        if ($periods <= 0) {
            return $targetValue;
        }

        // Calcula o valor por período
        return round($targetValue / $periods, 2);
    }

    /**
     * Realiza um depósito na meta
     */
    public function deposit(Request $request, Goal $goal)
    {
        // Verifica se a meta pertence ao usuário atual
        if ($goal->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para realizar depósitos nesta meta.');
        }

        // Verifica se a meta já está concluída
        if ($goal->status === 'concluída') {
            return redirect()->route('metas.show', $goal)
                ->with('error', 'Esta meta já foi concluída!');
        }

        // Valida o valor do depósito
        $request->validate([
            'deposit_value' => 'required|numeric|min:0.01'
        ]);

        $deposit_value = $request->deposit_value;
        $new_value = $goal->current_value + $deposit_value;

        // Verifica se o novo valor ultrapassaria o valor final
        if ($new_value > $goal->target_value) {
            return redirect()->route('metas.show', $goal)
                ->with('error', 'O valor do depósito ultrapassaria o valor final da meta! O valor máximo permitido é R$ ' . number_format($goal->target_value - $goal->current_value, 2, ',', '.'));
        }

        // Atualiza o valor atual da meta
        $goal->current_value = $new_value;

        // Verifica se atingiu o valor final
        if ($goal->current_value >= $goal->target_value) {
            $goal->status = 'concluída';
            $goal->current_value = $goal->target_value; // Garante que não ultrapasse o valor final
        }

        $goal->save();

        return redirect()->route('metas.show', $goal)
            ->with('success', 'Depósito realizado com sucesso!');
    }
}
