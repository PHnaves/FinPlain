@csrf
<input type="descricao" name="descricao" value="{{ $gasto->descricao ?? old('descricao') }}" placeholder="Pequena Descrição do gasto" required>
<input type="number" name="valor" value="{{ $gasto->valor ?? old('valor') }}" placeholder="Valor" required>

<!-- Select para definir se a despesa é recorrente -->
<label for="necessario">Esse Gasto Foi Necessario?</label>
<select name="necessario" id="necessario" required>
    <option value="sim">Sim</option>
    <option value="nao">Não</option>
</select>

<button type="submit">Salvar</button>
