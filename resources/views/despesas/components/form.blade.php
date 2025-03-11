@csrf
<input type="text" name="tipo" value="{{ $despesa->tipo ?? old('tipo') }}" placeholder="Nome da despesa" required>
<input type="number" name="valor" value="{{ $despesa->valor ?? old('valor') }}" placeholder="Valor" required>

<!-- Select para definir se a despesa é recorrente -->
<label for="recorrente">Despesa recorrente?</label>
<select name="recorrente" id="recorrente" required>
    <option value="0">Não</option>
    <option value="1">Sim</option>
</select>

<input type="date" name="data_vencimento" value="{{ $despesa->data_vencimento ?? old('data_vencimento') }}" placeholder="Data de Vencimento (Opcional)">

<button type="submit">Salvar</button>
