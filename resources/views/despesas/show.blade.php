<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhe da Despesa') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('despesas.edit', $expense->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar Despesa
                </a>
                <form action="{{ route('despesas.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?');">
                    @csrf
                    @method('DELETE')
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-500 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Excluir Despesa
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Cabeçalho da Despesa -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-6 border-b">
                        <div class="w-full md:w-auto">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 break-words">{{ $expense->expense_name }}</h1>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                    {{ $expense->expense_category }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($expense->payment_date) bg-green-100 text-green-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ $expense->payment_date ? 'Pago' : 'Pendente' }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 w-full md:w-auto flex flex-col items-start md:items-end gap-2">
                            <p class="text-sm text-gray-500">
                                Criada em: {{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}
                            </p>
                            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                                <a href="{{ route('despesas.edit', $expense->id) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar Despesa
                                </a>
                                <form action="{{ route('despesas.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?');" class="flex-1 md:flex-none">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-500 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Excluir Despesa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Grid Principal -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                        <!-- Coluna da Esquerda -->
                        <div class="lg:col-span-2 space-y-4 md:space-y-6">
                            <!-- Valor e Frequência -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Detalhes do Pagamento</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Valor Total</p>
                                        <p class="text-2xl font-bold text-gray-900">R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Frequência</p>
                                        <p class="text-lg font-medium text-gray-900">{{ ucfirst($expense->recurrence) }}</p>
                                    </div>
                                </div>
                                @if($expense->recurrence !== 'a vista' && $expense->installments > 0 && !$expense->payment_date)
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <p class="text-sm text-gray-600">Parcelas</p>
                                        <p class="text-lg font-medium text-gray-900">{{ $expense->installments }}x</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Descrição -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Descrição</h3>
                                <p class="text-gray-700 break-words">{{ $expense->expense_description ?? 'Descrição não fornecida' }}</p>
                            </div>
                        </div>

                        <!-- Coluna da Direita -->
                        <div class="space-y-4 md:space-y-6">
                            <!-- Datas -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Datas</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Vencimento</p>
                                        <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</p>
                                    </div>
                                    @if($expense->payment_date)
                                        <div>
                                            <p class="text-sm text-gray-600">Pagamento</p>
                                            <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                                @if($expense->payment_date)
                                    <div class="flex items-center justify-center p-4 bg-green-50 rounded-lg">
                                        <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <p class="text-green-700 font-medium">Despesa Paga!</p>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center p-4 bg-yellow-50 rounded-lg">
                                        <svg class="w-6 h-6 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-yellow-700 font-medium">Pagamento Pendente</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Botão de Pagamento -->
                            @if(!$expense->payment_date)
                                <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Realizar Pagamento</h3>
                                    <form action="{{ route('pay.expense', $expense->id) }}" method="POST" 
                                          onsubmit="return confirm('Confirmar pagamento desta despesa?');">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Confirmar Pagamento
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
