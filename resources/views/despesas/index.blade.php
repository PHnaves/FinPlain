<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transações</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

        {{-- Cards Topo --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-gray-100 rounded-lg h-28 flex items-center justify-center text-gray-500">Resultado previsto no mês</div>
            <div class="bg-gray-100 rounded-lg h-28 flex items-center justify-center">
                <img src="https://via.placeholder.com/300x80?text=Banco+Central+do+Brasil" alt="Publicidade">
            </div>
        </div>

        {{-- Filtros --}}
        <div class="flex items-center justify-between bg-white p-4 rounded shadow">
            <div class="flex items-center space-x-2">
                <button class="text-xl">←</button>
                <span class="text-lg font-semibold">Março</span>
                <button class="text-xl">→</button>
            </div>

            <div class="space-x-2">
                <a href="?recurrence=" class="px-3 py-1 rounded border {{ request('recurrence') === null ? 'bg-gray-200' : '' }}">Tudo</a>
                <a href="?recurrence=mensal" class="px-3 py-1 rounded border {{ request('recurrence') === 'mensal' ? 'bg-emerald-300' : '' }}">Fixas</a>
                <a href="?recurrence=única" class="px-3 py-1 rounded border {{ request('recurrence') === 'única' ? 'bg-gray-200' : '' }}">Variáveis</a>
            </div>
        </div>

        {{-- Tabela de Transações --}}
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2"><input type="checkbox" /></th>
                        <th class="px-4 py-2 text-left">Data</th>
                        <th class="px-4 py-2 text-left">Nome</th>
                        <th class="px-4 py-2 text-left">Descrição</th>
                        <th class="px-4 py-2 text-left">Categoria</th>
                        <th class="px-4 py-2 text-left">Valor</th>
                        <th class="px-4 py-2 text-left">Pagamento</th>
                        <th class="px-4 py-2 text-left">Recorrência</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($expenses as $expense)
                        <tr>
                            <td class="px-4 py-2"><input type="checkbox" /></td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $expense->expense_name }}</td>
                            <td class="px-4 py-2">{{ $expense->expense_description }}</td>
                            <td class="px-4 py-2">{{ $expense->expense_category }}</td>
                            <td class="px-4 py-2">R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if ($expense->installments && $expense->installments > 1)
                                    {{ "Parcelado ({$expense->installments}x)" }}
                                @else
                                    Único
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <span class="text-xs font-semibold px-2 py-1 rounded {{ $expense->recurrence === 'mensal' ? 'bg-teal-500 text-white' : 'bg-gray-200' }}">
                                    {{ ucfirst($expense->recurrence ?? 'única') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Adicionar transação --}}
            <div class="text-center py-4 border-t border-dashed border-gray-300 text-blue-600 cursor-pointer hover:underline">
                + Adicionar transação
            </div>
        </div>
    </div>
</x-app-layout>
