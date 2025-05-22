@csrf

<!-- Título da Meta -->
<div>
    <label for="goal_title" class="block text-sm font-medium text-gray-700">Título da Meta</label>
    <input type="text" id="goal_title" name="goal_title"
           placeholder="Título da Meta"
           value="{{ old('goal_title', isset($goal) ? $goal->goal_title : '') }}"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
           required>
</div>

<!-- Descrição -->
<div>
    <label for="goal_description" class="block text-sm font-medium text-gray-700">Descrição (opcional)</label>
    <textarea id="goal_description" name="goal_description"
              placeholder="Descrição da meta (opcional)"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">{{ old('goal_description', isset($goal) ? $goal->goal_description : '') }}</textarea>
</div>

<!-- Categoria -->
<div>
    <label for="goal_category" class="block text-sm font-medium text-gray-700">Categoria</label>
    <input list="goal_categories"
           name="goal_category"
           id="goal_category"
           placeholder="Escolha ou crie uma categoria"
           value="{{ old('goal_category', isset($goal) ? $goal->goal_category : '') }}"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
           required>
    <datalist id="goal_categories">
        @foreach ($goal_categories as $goal_category)
            <option value="{{ $goal_category }}">
        @endforeach
    </datalist>
</div>

<!-- Valor Final -->
<div>
    <label for="target_value" class="block text-sm font-medium text-gray-700">Valor Final (R$)</label>
    <input type="number" id="target_value" name="target_value"
           placeholder="Valor que deseja atingir"
           value="{{ old('target_value', isset($goal) ? $goal->target_value : '') }}"
           step="0.01"
           min="0"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
           required>
</div>

<!-- Valor Atual -->
<div>
    <label for="current_value" class="block text-sm font-medium text-gray-700">Valor Atual Guardado (R$)</label>
    <input type="number" id="current_value" name="current_value"
           placeholder="Quanto já foi guardado (opcional)"
           value="{{ old('current_value', isset($goal) ? $goal->current_value : '') }}"
           step="0.01"
           min="0"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
</div>

<!-- Frequência -->
<div>
    <label for="frequency" class="block text-sm font-medium text-gray-700">Frequência da Poupança</label>
    <select name="frequency" id="frequency" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
            required>
        <option value="semanal" {{ old('frequency', isset($goal) ? $goal->frequency : '') == 'semanal' ? 'selected' : '' }}>Semanal</option>
        <option value="mensal" {{ old('frequency', isset($goal) ? $goal->frequency : '') == 'mensal' ? 'selected' : '' }}>Mensal</option>
    </select>
</div>

<!-- Valor por Período -->
<div>
    <label for="recurring_value" class="block text-sm font-medium text-gray-700">Valor por Período (R$)</label>
    <input type="number" id="recurring_value" name="recurring_value"
           placeholder="Quanto pretende guardar a cada período"
           value="{{ old('recurring_value', isset($goal) ? $goal->recurring_value : '') }}"
           step="0.01"
           min="0"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
           required>
</div>

<!-- Status (somente em edição) -->
@if(isset($goal) && isset($goal->id))
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                required>
            <option value="andamento" {{ old('status', $goal->status) == 'andamento' ? 'selected' : '' }}>Em andamento</option>
            <option value="concluída" {{ old('status', $goal->status) == 'concluída' ? 'selected' : '' }}>Concluída</option>
            <option value="cancelada" {{ old('status', $goal->status) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>
    </div>
@endif

<!-- Data final -->
<div>
    <label for="end_date" class="block text-sm font-medium text-gray-700">Data Final Que Deseja Atingir a Meta</label>
    <input type="date" id="end_date" name="end_date"
           value="{{ old('end_date', isset($goal) && $goal->end_date ? \Carbon\Carbon::parse($goal->end_date)->format('Y-m-d') : '') }}"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
</div>

<!-- Botão -->
<div class="flex justify-end">
    <button type="submit"
            class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-1 transition">
        Salvar Meta
    </button>
</div>
