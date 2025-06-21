@csrf

<!-- Nome da Transação -->
<div>
    <label for="expense_name" class="block text-sm font-medium text-gray-700">Nome da Transação</label>
    <input type="text" id="expense_name" name="expense_name"
        value="{{ old('expense_name', isset($expense) ? $expense->expense_name : '') }}"
        placeholder="Ex: Aluguel de apartamento"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
        <x-input-error class="mt-2" :messages="$errors->get('expense_name')" />
</div>

<!-- Descrição da Transação -->
<div>
    <label for="expense_description" class="block text-sm font-medium text-gray-700">Descrição</label>
    <textarea id="expense_description" name="expense_description"
        placeholder="Ex: Pagamento referente ao mês de abril"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>{{ old('expense_description', isset($expense) ? $expense->expense_description : '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('expense_description')" />
</div>

<!-- Categoria -->
<div>
    <label for="expense_category" class="block text-sm font-medium text-gray-700">Categoria</label>
    <input list="expense_categories" name="expense_category" id="expense_category"
        value="{{ old('expense_category', isset($expense) ? $expense->expense_category : '') }}"
        placeholder="Escolha ou crie uma categoria"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
    <x-input-error class="mt-2" :messages="$errors->get('expense_category')" />
    <datalist id="expense_categories">
        @foreach ($expense_categories as $expense_category)
            <option value="{{ $expense_category }}">
        @endforeach
    </datalist>
</div>

<!-- Valor da Transação -->
<div>
    <label for="expense_value" class="block text-sm font-medium text-gray-700">Valor das Parcelas da transação</label>
    <input type="number" id="expense_value" name="expense_value" 
        min="1"
        max="99999999,99"
        value="{{ old('expense_value', isset($expense) ? $expense->expense_value : '') }}"
        placeholder="Ex: 1200.00" step="0.01"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
        <x-input-error class="mt-2" :messages="$errors->get('expense_value')" />
</div>

<!-- Frequência -->
<div>
    <label for="recurrence" class="block text-sm font-medium text-gray-700">Frequência</label>
    <select name="recurrence" id="recurrence"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
        @foreach (['a vista', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'] as $option)
            <option value="{{ $option }}" {{ old('recurrence', isset($expense) ? $expense->recurrence : '') === $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('recurrence')" />
</div>

<!-- Parcelas -->
<div id="installments_field" style="display: none;">
    <label for="installments" class="block text-sm font-medium text-gray-700">Quantidade de Parcelas</label>
    <input type="number" id="installments" name="installments"
        value="{{ old('installments', isset($expense) ? ($expense->payment_date ? 0 : $expense->installments) : 0) }}"
        placeholder="Ex: 3" min="0"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        {{ isset($expense) && $expense->payment_date ? 'disabled' : '' }}>
        <x-input-error class="mt-2" :messages="$errors->get('installments')" />
</div>

<!-- Data de vencimento -->
<div>
    <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento da Proxima Parcela</label>
    <input type="date" id="due_date" name="due_date"
        value="{{ old('due_date', isset($expense) && $expense->due_date ? \Carbon\Carbon::parse($expense->due_date)->format('Y-m-d') : '') }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
        <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
</div>

<!-- Apenas no modo edição -->
@if(isset($expense) && isset($expense->id))
    <div>
        <label for="payment_date" class="block text-sm font-medium text-gray-700">Data de Pagamento</label>
        <input type="datetime-local" id="payment_date" name="payment_date" autocomplete="off"
            value="{{ old('payment_date', $expense->payment_date ? \Carbon\Carbon::parse($expense->payment_date)->format('Y-m-d\TH:i') : '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
            <x-input-error class="mt-2" :messages="$errors->get('payment_date')" />
    </div>
@endif

<!-- Botão -->
<div class="flex justify-end">
    <button type="submit"
        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-1 transition">
        Salvar
    </button>
</div>