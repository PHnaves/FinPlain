@csrf

<input type="text" name="titulo" placeholder="Título da Meta" value="{{ old('titulo', $meta->titulo ?? '') }}" required>

<textarea name="descricao" placeholder="Descrição (opcional)">{{ old('descricao', $meta->descricao ?? '') }}</textarea>

<input type="number" name="valor_final" placeholder="Valor Final (R$)" value="{{ old('valor_final', $meta->valor_final ?? '') }}" required>

<input type="number" name="valor_atual" placeholder="Valor atual já guardado (R$)" value="{{ old('valor_atual', $meta->valor_atual ?? '') }}">

<input type="number" name="valor_periodico" placeholder="Valor a Guardar por Período (R$)" value="{{ old('valor_periodico', $meta->valor_periodico ?? '') }}" required>

<label for="periodicidade">Periodicidade:</label>
<select name="periodicidade" id="periodicidade" required>
    <option value="semanal" {{ old('periodicidade', $meta->periodicidade ?? '') == 'semanal' ? 'selected' : '' }}>Semanal</option>
    <option value="mensal" {{ old('periodicidade', $meta->periodicidade ?? '') == 'mensal' ? 'selected' : '' }}>Mensal</option>
</select>

<!-- Exibir o campo de "Status" apenas se estamos editando uma meta -->
@if(isset($meta->id))
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="andamento" {{ old('status', $meta->status ?? '') == 'andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="concluída" {{ old('status', $meta->status ?? '') == 'concluída' ? 'selected' : '' }}>Concluída</option>
        <option value="cancelada" {{ old('status', $meta->status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
@endif

<button type="submit">Salvar Meta</button>
