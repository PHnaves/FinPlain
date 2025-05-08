<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhe da Meta') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('metas.edit', $goal->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar Meta
                </a>
                <form action="{{ route('metas.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                    @csrf
                    @method('DELETE')
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-500 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Excluir Meta
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
                    <!-- Cabeçalho da Meta -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-6 border-b">
                        <div class="w-full md:w-auto">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 break-words">{{ $goal->goal_title }}</h1>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                    {{ $goal->goal_category }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($goal->status === 'concluída') bg-green-100 text-green-800
                                    @elseif($goal->status === 'andamento') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($goal->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 w-full md:w-auto flex flex-col items-start md:items-end gap-2">
                            <p class="text-sm text-gray-500">
                                Criada em: {{ $goal->created_at->format('d/m/Y') }}
                            </p>
                            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                                <a href="{{ route('metas.edit', $goal->id) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar Meta
                                </a>
                                <form action="{{ route('metas.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');" class="flex-1 md:flex-none">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-500 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Excluir Meta
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Grid Principal -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                        <!-- Coluna da Esquerda -->
                        <div class="lg:col-span-2 space-y-4 md:space-y-6">
                            <!-- Progresso -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Progresso da Meta</h3>
                                <div class="h-48 md:h-64">
                                    <canvas id="goalProgressChart"></canvas>
                                </div>
                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Valor Atual</p>
                                        <p class="text-lg md:text-xl font-bold text-gray-900">R$ {{ number_format($goal->current_value, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-sm text-gray-600">Valor Final</p>
                                        <p class="text-lg md:text-xl font-bold text-gray-900">R$ {{ number_format($goal->target_value, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Descrição</h3>
                                <p class="text-gray-700 break-words">{{ $goal->goal_description ?? 'Descrição não fornecida' }}</p>
                            </div>
                        </div>

                        <!-- Coluna da Direita -->
                        <div class="space-y-4 md:space-y-6">
                            <!-- Detalhes -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Detalhes</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Frequência</p>
                                        <p class="font-medium text-gray-900 break-words">{{ ucfirst($goal->frequency) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Valor por Período</p>
                                        <p class="font-medium text-gray-900">R$ {{ number_format($goal->recurring_value, 2, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Data Final</p>
                                        <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($goal->end_date)->format('d/m/Y') ?? 'Não definida' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Data Estimada de Conclusão</p>
                                        <p class="font-medium text-gray-900 break-words">{{ $conclusion_date ?? 'Não calculada' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Depósito -->
                            @if($goal->status !== 'concluída')
                                <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Realizar Depósito</h3>
                                    <form action="{{ route('deposit.goal', $goal->id) }}" method="POST">
                                        @csrf
                                        <div class="space-y-4">
                                            <div>
                                                <label for="deposit_value" class="block text-sm font-medium text-gray-700">Valor do Depósito</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">R$</span>
                                                    </div>
                                                    <input type="number" 
                                                           name="deposit_value" 
                                                           id="deposit_value"
                                                           class="block w-full pl-7 pr-12 py-2 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                           placeholder="0.00"
                                                           required 
                                                           min="0.01" 
                                                           step="0.01" 
                                                           max="{{ $goal->target_value - $goal->current_value }}">
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500 break-words">
                                                    Valor máximo permitido: R$ {{ number_format($goal->target_value - $goal->current_value, 2, ',', '.') }}
                                                </p>
                                            </div>
                                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Confirmar Depósito
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                                    <div class="flex items-center justify-center p-4 bg-green-50 rounded-lg">
                                        <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <p class="text-green-700 font-medium">Meta Concluída!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para os gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados para o gráfico de progresso
        const progressData = @json($progressData);
        const goal = @json($goal);

        const ctx = document.getElementById('goalProgressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: progressData.map(point => point.date),
                datasets: [{
                    label: 'Progresso da Meta',
                    data: progressData.map(point => point.value),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const percentage = (value / goal.target_value) * 100;
                                return [
                                    `Valor: R$ ${value.toFixed(2)}`,
                                    `Progresso: ${percentage.toFixed(1)}%`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: parseFloat(goal.target_value),
                        title: {
                            display: true,
                            text: 'Valor (R$)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toFixed(2);
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
