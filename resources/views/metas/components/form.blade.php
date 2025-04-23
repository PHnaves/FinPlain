@csrf

<!-- Título da Meta -->
<label for="goal_title">Título da Meta</label>
<input type="text" id="goal_title" name="goal_title"
       placeholder="Título da Meta"
       value="{{ old('goal_title', $goal->goal_title ?? '') }}"
       required>

<!-- Descrição -->
<label for="goal_description">Descrição (opcional)</label>
<textarea id="goal_description" name="goal_description"
          placeholder="Descrição da meta (opcional)">{{ old('goal_description', $goal->goal_description ?? '') }}</textarea>

<!-- Categoria -->
<label for="goal_category">Categoria</label>
<input list="goal_categories"
       name="goal_category"
       id="goal_category"
       placeholder="Escolha ou crie uma categoria"
       value="{{ old('goal_category', $goal->goal_category ?? '') }}"
       required>
<datalist id="goal_categories">
    @foreach ($goal_categories as $goal_category)
        <option value="{{ $goal_category }}">
    @endforeach
</datalist>

<!-- Valor Final -->
<label for="target_value">Valor Final (R$)</label>
<input type="number" id="target_value" name="target_value"
       placeholder="Valor que deseja atingir"
       value="{{ old('target_value', $goal->target_value ?? '') }}"
       step="0.01"
       min="0"
       required>

<!-- Valor Atual -->
<label for="current_value">Valor Atual Guardado (R$)</label>
<input type="number" id="current_value" name="current_value"
       placeholder="Quanto já foi guardado (opcional)"
       value="{{ old('current_value', $goal->current_value ?? '') }}"
       step="0.01"
       min="0">

<!-- Frequência -->
<label for="frequency">Frequência da Poupança</label>
<select name="frequency" id="frequency" required>
    <option value="semanal" {{ old('frequency', $goal->frequency ?? '') == 'semanal' ? 'selected' : '' }}>Semanal</option>
    <option value="mensal" {{ old('frequency', $goal->frequency ?? '') == 'mensal' ? 'selected' : '' }}>Mensal</option>
</select>

<!-- Valor por Período -->
<label for="recurring_value">Valor por Período (R$)</label>
<input type="number" id="recurring_value" name="recurring_value"
       placeholder="Quanto pretende guardar a cada período"
       value="{{ old('recurring_value', $goal->recurring_value ?? '') }}"
       step="0.01"
       min="0"
       required>

<!-- Status (somente em edição) -->
@if(isset($goal->id))
    <label for="status">Status</label>
    <select name="status" id="status" required>
        <option value="andamento" {{ old('status', $goal->status ?? '') == 'andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="concluída" {{ old('status', $goal->status ?? '') == 'concluída' ? 'selected' : '' }}>Concluída</option>
        <option value="cancelada" {{ old('status', $goal->status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
@endif

<!-- Data final -->
<label for="end_date">Data Limite (opcional)</label>
<input type="date" id="end_date" name="end_date"
       value="{{ old('end_date', $goal->end_date ?? '') }}">

<!-- Botão -->
<button type="submit">Salvar Meta</button>
