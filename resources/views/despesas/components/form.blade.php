@csrf

<!-- Nome da Despesa -->
<label for="expense_name">Nome da Despesa</label>
<input type="text" id="expense_name" name="expense_name"
       value="{{ old('expense_name', $expense->expense_name ?? '') }}"
       placeholder="Ex: Aluguel de apartamento"
       required>

<!-- Descrição da Despesa -->
<label for="expense_description">Descrição</label>
<textarea id="expense_description" name="expense_description"
          placeholder="Ex: Pagamento referente ao mês de abril"
          required>{{ old('expense_description', $expense->expense_description ?? '') }}</textarea>

<!-- Categoria -->
<label for="expense_category">Categoria</label>
<input list="expense_categories" name="expense_category" id="expense_category"
       value="{{ old('expense_category', $expense->expense_category ?? '') }}"
       placeholder="Escolha ou crie uma categoria" required>
<datalist id="expense_categories">
    @foreach ($expense_categories as $expense_category)
        <option value="{{ $expense_category }}">
    @endforeach
</datalist>

<!-- Valor da Despesa -->
<label for="expense_value">Valor da Despesa</label>
<input type="number" id="expense_value" name="expense_value"
       value="{{ old('expense_value', $expense->expense_value ?? '') }}"
       placeholder="Ex: 1200.00" step="0.01" required>

<!-- Frequência -->
<label for="recurrence">Frequência</label>
<select name="recurrence" id="recurrence" required>
    @foreach (['a vista', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'] as $option)
        <option value="{{ $option }}" {{ old('recurrence', $expense->recurrence ?? '') === $option ? 'selected' : '' }}>
            {{ ucfirst($option) }}
        </option>
    @endforeach
</select>

<!-- Parcelas -->
<div id="installments_field" style="display: none;">
    <label for="installments">Número de Parcelas</label>
    <input type="number" id="installments" name="installments"
           value="{{ old('installments', $expense->installments ?? 1) }}"
           placeholder="Ex: 3" min="1">
</div>

<!-- Data de vencimento -->
<label for="due_date">Data de Vencimento</label>
<input type="date" id="due_date" name="due_date"
       value="{{ old('due_date', $expense->due_date ?? '') }}">

<!-- Apenas no modo edição -->
@if(isset($expense->id))
    <label for="payment_date">Data de Pagamento</label>
    <input type="datetime-local" id="payment_date" name="payment_date" autocomplete="off"
           value="{{ old('payment_date', $expense->payment_date ? \Carbon\Carbon::parse($expense->payment_date)->format('Y-m-d\TH:i') : '') }}">
@endif

<!-- Botão -->
<button type="submit">Salvar</button>

<!-- Script para exibir ou esconder parcelas -->
<script>
    const recurrence = document.getElementById('recurrence');
    const installmentsField = document.getElementById('installments_field');
    const installmentsInput = document.getElementById('installments');

    function toggleInstallments() {
        if (recurrence.value === 'a vista') {
            installmentsField.style.display = 'none';
            installmentsInput.value = 1;
        } else {
            installmentsField.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', toggleInstallments);
    recurrence.addEventListener('change', toggleInstallments);
</script>
