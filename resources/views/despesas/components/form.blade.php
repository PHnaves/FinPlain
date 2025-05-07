@csrf

<!-- Nome da Despesa -->
<div>
    <label for="expense_name" class="block text-sm font-medium text-gray-700">Nome da Despesa</label>
    <input type="text" id="expense_name" name="expense_name"
        value="{{ old('expense_name', $expense->expense_name ?? '') }}"
        placeholder="Ex: Aluguel de apartamento"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        required>
</div>

<!-- Descrição da Despesa -->
<div>
    <label for="expense_description" class="block text-sm font-medium text-gray-700">Descrição</label>
    <textarea id="expense_description" name="expense_description"
        placeholder="Ex: Pagamento referente ao mês de abril"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        required>{{ old('expense_description', $expense->expense_description ?? '') }}</textarea>
</div>

<!-- Categoria -->
<div>
    <label for="expense_category" class="block text-sm font-medium text-gray-700">Categoria</label>
    <input list="expense_categories" name="expense_category" id="expense_category"
        value="{{ old('expense_category', $expense->expense_category ?? '') }}"
        placeholder="Escolha ou crie uma categoria"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        required>
    <datalist id="expense_categories">
        @foreach ($expense_categories as $expense_category)
            <option value="{{ $expense_category }}">
        @endforeach
    </datalist>
</div>

<!-- Valor da Despesa -->
<div>
    <label for="expense_value" class="block text-sm font-medium text-gray-700">Valor da Despesa</label>
    <input type="number" id="expense_value" name="expense_value"
        value="{{ old('expense_value', $expense->expense_value ?? '') }}"
        placeholder="Ex: 1200.00" step="0.01"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        required>
</div>

<!-- Frequência -->
<div>
    <label for="recurrence" class="block text-sm font-medium text-gray-700">Frequência</label>
    <select name="recurrence" id="recurrence"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        required>
        @foreach (['a vista', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'] as $option)
            <option value="{{ $option }}" {{ old('recurrence', $expense->recurrence ?? '') === $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
</div>

<!-- Parcelas -->
<div id="installments_field" style="display: none;">
    <label for="installments" class="block text-sm font-medium text-gray-700">Número de Parcelas</label>
    <input type="number" id="installments" name="installments"
        value="{{ old('installments', $expense->installments ?? 1) }}"
        placeholder="Ex: 3" min="1"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
</div>

<!-- Data de vencimento -->
<div>
    <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento</label>
    <input type="date" id="due_date" name="due_date"
        value="{{ old('due_date', $expense->due_date ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
</div>

<!-- Apenas no modo edição -->
@if(isset($expense->id))
    <div>
        <label for="payment_date" class="block text-sm font-medium text-gray-700">Data de Pagamento</label>
        <input type="datetime-local" id="payment_date" name="payment_date" autocomplete="off"
            value="{{ old('payment_date', $expense->payment_date ? \Carbon\Carbon::parse($expense->payment_date)->format('Y-m-d\TH:i') : '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>
@endif

<!-- Botão -->
<div class="flex justify-end">
    <button type="submit"
        class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition">
        Salvar
    </button>
</div>