@csrf

<input type="text" name="goal_title" placeholder="Título da Meta" value="{{ old('goal_title', $goal->goal_title ?? '') }}" required>

<textarea name="goal_description" placeholder="Descrição (opcional)">{{ old('goal_description', $goal->goal_description ?? '') }}</textarea>

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


<input type="number" name="target_value" placeholder="Valor Final (R$)" value="{{ old('target_value', $goal->target_value ?? '') }}" required>

<input type="number" name="current_value" placeholder="Valor atual já guardado (R$)" value="{{ old('current_value', $goal->current_value ?? '') }}">

<label for="frequency">Frequencia:</label>
<select name="frequency" id="frequency" required>
    <option value="semanal" {{ old('frequency', $goal->frequency ?? '') == 'semanal' ? 'selected' : '' }}>Semanal</option>
    <option value="mensal" {{ old('frequency', $goal->frequency ?? '') == 'mensal' ? 'selected' : '' }}>Mensal</option>
</select>

<input type="number" name="recurring_value" placeholder="Valor a Guardar por Período (R$)" value="{{ old('recurring_value', $goal->recurring_value ?? '') }}" required>

<!-- Exibir o campo de "Status" apenas se estamos editando uma goal -->
@if(isset($goal->id))
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="andamento" {{ old('status', $goal->status ?? '') == 'andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="concluída" {{ old('status', $goal->status ?? '') == 'concluída' ? 'selected' : '' }}>Concluída</option>
        <option value="cancelada" {{ old('status', $goal->status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
@endif

{{-- data final --}}
<input type="date" name="end_date" value="{{ old('end_date', $goal->end_date ?? '') }}">

<button type="submit">Salvar Meta</button>
