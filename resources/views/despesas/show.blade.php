<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhe Despesa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1>Detalhe Das Despesas</h1>

                    <!-- Informações da despesa -->
                    <div class="flex flex-col space-y-4 w-full">
                        <!-- Nome da despesa -->
                        <h2 class="text-3xl font-bold text-gray-500">{{ $expense->expense_name }}</h2>

                        <!-- Descrição da despesa -->
                        <p class="text-lg text-gray-500">{{ $expense->expense_description }}</p>

                        <!-- Categoria da despesa -->
                        <p class="text-lg text-gray-500"><strong>Categoria:</strong> {{ $expense->expense_category }}</p>

                        <!-- Valor da despesa -->
                        <p class="text-xl font-semibold text-gray-700">R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</p>

                        <!-- Frequência da despesa -->
                        <p class="text-lg text-gray-500"><strong>Frequência:</strong> {{ ucfirst($expense->recurrence) }}</p>

                        <!-- Número de parcelas, se houver -->
                        @if($expense->frequency != 'a vista' && $expense->installments)
                            <p class="text-lg text-gray-500"><strong>Número de parcelas:</strong> {{ $expense->installments }}</p>
                        @endif

                        <!-- Data -->
                        <div class="text-gray-500 text-sm">
                            <p><strong>Data de Vencimento:</strong> {{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</p>
                        </div>

                        <!-- Data de pagamento, se houver -->
                        @if($expense->payment_date)
                            <div class="text-gray-500 text-sm">
                                <p><strong>Data de Pagamento:</strong> {{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') }}</p>
                            </div>
                        @endif

                        <!-- Informações sobre a criação e edição -->
                        <div class="text-gray-500 text-sm mt-4">
                            <p><strong>Postado em:</strong> {{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y H:i') }}</p>
                            {{-- Lógica para mostrar se a despesa foi editada ou não --}}
                            @if (is_null($expense->updated_at) || $expense->updated_at == $expense->created_at)
                                <p>Despesa ainda não editada</p>
                            @else
                                <p><strong>Editado em:</strong> {{ \Carbon\Carbon::parse($expense->updated_at)->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>

                        <!-- Ações -->
                        <div class="flex justify-start space-x-6 mt-4">
                            <!-- Formulário para excluir despesa -->
                            <form action="{{ route('despesas.destroy', $expense->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?');">
                                @csrf
                                @method('delete')
                                <button class="py-2 px-6 rounded-lg bg-red-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 cursor-pointer">
                                    Excluir Despesa
                                </button>
                            </form>
                            
                            <!-- Botão para editar despesa -->
                            <a href="{{ route('despesas.edit', $expense->id) }}" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Editar Despesa
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
