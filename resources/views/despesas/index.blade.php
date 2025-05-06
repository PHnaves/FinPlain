<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transações</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        {{-- Cards Topo --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gray-100 rounded-lg h-28 flex items-center justify-center text-gray-500">Resultado previsto no mês</div>
            <div class="bg-gray-100 rounded-lg h-28 flex items-center justify-center">
                <img src="https://via.placeholder.com/300x80?text=Banco+Central+do+Brasil" alt="Publicidade" class="w-full h-auto object-contain">
            </div>
        </div>

        {{-- Filtros --}}
        <div class="flex flex-col sm:flex-row items-center justify-between bg-white p-4 rounded-lg shadow space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <a href="?month={{ \Carbon\Carbon::parse($currentMonth . '/01/' . $currentYear)->subMonth()->format('m') }}&year={{ \Carbon\Carbon::parse($currentMonth . '/01/' . $currentYear)->subMonth()->format('Y') }}&recurrence={{ $recurrence }}" 
                   class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <span class="text-lg font-semibold text-gray-700">
                    {{ \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->locale('pt_BR')->isoFormat('MMMM YYYY') }}
                </span>
                <a href="?month={{ \Carbon\Carbon::parse($currentMonth . '/01/' . $currentYear)->addMonth()->format('m') }}&year={{ \Carbon\Carbon::parse($currentMonth . '/01/' . $currentYear)->addMonth()->format('Y') }}&recurrence={{ $recurrence }}" 
                   class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="flex flex-wrap justify-center sm:justify-end gap-2">
                <a href="?month={{ $currentMonth }}&year={{ $currentYear }}" 
                   class="px-4 py-2 rounded-lg border-2 {{ request('recurrence') === null ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-600 hover:border-primary hover:text-primary' }} transition-colors">
                    Tudo
                </a>
                <a href="?month={{ $currentMonth }}&year={{ $currentYear }}&recurrence=mensal" 
                   class="px-4 py-2 rounded-lg border-2 {{ request('recurrence') === 'mensal' ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-600 hover:border-primary hover:text-primary' }} transition-colors">
                    Fixas
                </a>
                <a href="?month={{ $currentMonth }}&year={{ $currentYear }}&recurrence=única" 
                   class="px-4 py-2 rounded-lg border-2 {{ request('recurrence') === 'única' ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-600 hover:border-primary hover:text-primary' }} transition-colors">
                    Variáveis
                </a>
            </div>
        </div>

        {{-- Tabela de Transações --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="hidden md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                <th class="hidden sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                <th class="hidden sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pagamento</th>
                                <th class="hidden md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recorrência</th>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="8" class="px-4 sm:px-6 py-4">
                                <a href="{{ route('despesas.create') }}" class="text-center block w-full px-4 py-3 rounded-lg border-2 border-dashed border-gray-300 text-gray-600 hover:border-primary hover:text-primary transition-colors">
                                    + Adicionar transação
                                </a>
                            </td>
                        </tr>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($expenses as $expense)
                                <tr class="hover:bg-gray-50 transition-colors group cursor-pointer" onclick="window.location='{{ route('despesas.show', $expense) }}'">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-5 h-5 rounded border-2 {{ $expense->payment_date ? 'bg-primary border-primary' : 'border-gray-300' }} flex items-center justify-center">
                                                @if($expense->payment_date)
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-gray-900 group-hover:text-primary transition-colors">{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-gray-900 group-hover:text-primary transition-colors">{{ $expense->expense_name }}</td>
                                    <td class="hidden md:table-cell px-4 sm:px-6 py-4 text-gray-900 group-hover:text-primary transition-colors">{{ $expense->expense_description }}</td>
                                    <td class="hidden sm:table-cell px-4 sm:px-6 py-4 whitespace-nowrap text-gray-900 group-hover:text-primary transition-colors">{{ $expense->expense_category }}</td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-gray-900 font-medium group-hover:text-primary transition-colors">R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</td>
                                    <td class="hidden sm:table-cell px-4 sm:px-6 py-4 whitespace-nowrap text-gray-900">
                                        @if ($expense->installments && $expense->installments > 1)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 group-hover:bg-blue-200 transition-colors">
                                                {{ "Parcelado ({$expense->installments}x)" }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 group-hover:bg-gray-200 transition-colors">
                                                Único
                                            </span>
                                        @endif
                                    </td>
                                    <td class="hidden md:table-cell px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $expense->recurrence === 'mensal' ? 'bg-primary/10 text-primary group-hover:bg-primary/20' : 'bg-gray-100 text-gray-800 group-hover:bg-gray-200' }} transition-colors">
                                            {{ ucfirst($expense->recurrence ?? 'única') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
