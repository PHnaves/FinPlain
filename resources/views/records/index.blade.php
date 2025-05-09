<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Gastos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Filtrar Gastos</h3>
                        <form action="{{ route('relatorios.filtrar') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Data de Vencimento:</label>
                                    <input type="date" name="due_date" value="{{ old('due_date', request('due_date')) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Data de Pagamento:</label>
                                    <input type="date" name="payment_date" value="{{ old('payment_date', request('payment_date')) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Categoria:</label>
                                    <input type="text" name="expense_category" value="{{ old('expense_category', request('expense_category')) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Recorrência:</label>
                                    <select name="recurrence" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Todas</option>
                                        @foreach(['a vista', 'semanal', 'quinzenal', 'mensal', 'trimestral', 'semestral', 'anual'] as $option)
                                            <option value="{{ $option }}" {{ request('recurrence') == $option ? 'selected' : '' }}>
                                                {{ ucfirst($option) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filtrar
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(isset($expenses))
                        <div class="mt-8">
                            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold mb-2">Resumo</h3>
                                <p>Total de Gastos: R$ {{ number_format($total, 2, ',', '.') }}</p>
                                <p>Quantidade de Gastos: {{ $expenses->count() }}</p>
                                <p>Média por Gasto: R$ {{ number_format($expenses->count() > 0 ? $total / $expenses->count() : 0, 2, ',', '.') }}</p>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Data de Vencimento</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Descrição</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Valor</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Categoria</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Recorrência</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($expenses as $expense)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $expense->expense_description }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    R$ {{ number_format($expense->expense_value, 2, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $expense->expense_category }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $expense->recurrence }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <form action="{{ route('relatorio.gerar') }}" method="GET">
                                    <input type="hidden" name="due_date" value="{{ request('due_date') }}">
                                    <input type="hidden" name="payment_date" value="{{ request('payment_date') }}">
                                    <input type="hidden" name="expense_category" value="{{ request('expense_category') }}">
                                    <input type="hidden" name="recurrence" value="{{ request('recurrence') }}">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Gerar PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
