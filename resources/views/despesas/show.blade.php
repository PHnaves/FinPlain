<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhe Despesa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Cabeçalho -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Detalhes da Despesa</h1>
                        <div class="flex space-x-4">
                            <!-- Botão para editar despesa -->
                            <a href="{{ route('despesas.edit', $expense->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>

                            <!-- Formulário para excluir despesa -->
                            <form action="{{ route('despesas.destroy', $expense->id) }}" method="post" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?');" 
                                  class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Informações da despesa -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Coluna da esquerda -->
                        <div class="space-y-6">
                            <!-- Nome e Categoria -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $expense->expense_name }}</h2>
                                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                                    {{ $expense->expense_category }}
                                </span>
                            </div>

                            <!-- Descrição -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Descrição</h3>
                                <p class="text-gray-700">{{ $expense->expense_description }}</p>
                            </div>

                            <!-- Valor e Frequência -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Valor</h3>
                                        <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-sm font-medium text-gray-500">Frequência</h3>
                                        <p class="text-lg font-medium text-gray-800">{{ ucfirst($expense->recurrence) }}</p>
                                    </div>
                                </div>

                                @if($expense->recurrence !== 'a vista' && $expense->installments > 0 && !$expense->payment_date)
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <h3 class="text-sm font-medium text-gray-500 mb-2">Parcelas</h3>
                                        <p class="text-lg font-medium text-gray-800">{{ $expense->installments }}x</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Coluna da direita -->
                        <div class="space-y-6">
                            <!-- Datas -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Datas</h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Vencimento</p>
                                        <p class="text-lg font-medium text-gray-800">{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</p>
                                    </div>
                                    @if($expense->payment_date)
                                        <div>
                                            <p class="text-sm text-gray-500">Pagamento</p>
                                            <p class="text-lg font-medium text-gray-800">{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Status</h3>
                                @if($expense->payment_date)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Pago
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Pendente
                                    </span>
                                @endif
                            </div>

                            <!-- Informações do sistema -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Informações do Sistema</h3>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <p>Criado em: {{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y H:i') }}</p>
                                    @if($expense->updated_at && $expense->updated_at != $expense->created_at)
                                        <p>Última edição: {{ \Carbon\Carbon::parse($expense->updated_at)->format('d/m/Y H:i') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botão de Pagamento -->
                    @if(!$expense->payment_date)
                        <div class="mt-6 flex justify-end">
                            <form action="{{ route('pay.expense', $expense->id) }}" method="POST" 
                                  onsubmit="return confirm('Confirmar pagamento desta despesa?');">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Pagar Despesa
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
