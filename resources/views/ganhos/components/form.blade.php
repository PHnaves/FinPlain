@csrf

<!-- Título do Ganho -->
<div>
    <label for="title" class="block text-sm font-medium text-gray-700">Título do Ganho</label>
    <input type="text" id="title" name="title"
        value="{{ old('title', isset($earning) ? $earning->title : '') }}"
        placeholder="Ex: Salário, Bônus, Venda de produto"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
    <x-input-error class="mt-2" :messages="$errors->get('title')" />
</div>

<!-- Descrição do Ganho -->
<div>
    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
    <textarea id="description" name="description"
        placeholder="Ex: Salário referente ao mês de abril"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
    >{{ old('description', isset($earning) ? $earning->description : '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<!-- Valor Recebido -->
<div>
    <label for="value" class="block text-sm font-medium text-gray-700">Valor Recebido</label>
    <input type="number" id="value" name="value"
        min="0"
        max="99999999,99"
        value="{{ old('value', isset($earning) ? $earning->value : '') }}"
        placeholder="Ex: 2500.00" step="0.01"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
    <x-input-error class="mt-2" :messages="$errors->get('value')" />
</div>

<!-- Recorrência -->
<div>
    <label for="recurrence" class="block text-sm font-medium text-gray-700">Recorrência</label>
    <select name="recurrence" id="recurrence"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
        @foreach (['unico', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'] as $option)
            <option value="{{ $option }}" {{ old('recurrence', isset($earning) ? $earning->recurrence : '') === $option ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('recurrence')" />
</div>

<!-- Data de Recebimento -->
<div>
    <label for="received_at" class="block text-sm font-medium text-gray-700">Data de Recebimento</label>
    <input type="date" id="received_at" name="received_at"
        value="{{ old('received_at', isset($earning) && $earning->received_at ? \Carbon\Carbon::parse($earning->received_at)->format('Y-m-d') : '') }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
        required>
    <x-input-error class="mt-2" :messages="$errors->get('received_at')" />
</div>

<!-- Botão -->
<div class="flex justify-end">
    <button type="submit"
        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-1 transition">
        Salvar
    </button>
</div> 