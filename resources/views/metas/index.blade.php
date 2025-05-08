<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Minhas Metas Financeiras') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Botão Nova Meta -->
            <div class="mb-6">
                <a href="{{ route('metas.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nova Meta
                </a>
            </div>

            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de Metas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goals->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Concluídas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goals->where('status', 'concluída')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Em Andamento</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goals->where('status', 'andamento')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Canceladas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goals->where('status', 'cancelada')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-4">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('metas.index') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === null ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Todas
                        </a>
                        <a href="{{ route('metas.index', ['status' => 'andamento']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'andamento' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Em Andamento
                        </a>
                        <a href="{{ route('metas.index', ['status' => 'concluída']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'concluída' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Concluídas
                        </a>
                        <a href="{{ route('metas.index', ['status' => 'cancelada']) }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium {{ request('status') === 'cancelada' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Canceladas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Distribuição de Valores -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribuição de Valores</h3>
                        <div class="h-64">
                            <canvas id="valueDistributionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Distribuição por Categoria -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribuição por Categoria</h3>
                        <div class="h-64">
                            <canvas id="categoryDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Metas -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Atual</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor Final</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($goals as $goal)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $goal->goal_title }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $goal->goal_category }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">R$ {{ number_format($goal->current_value, 2, ',', '.') }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">R$ {{ number_format($goal->target_value, 2, ',', '.') }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                @if($goal->status === 'concluída') bg-green-100 text-green-800
                                                @elseif($goal->status === 'andamento') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($goal->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('metas.show', $goal->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('metas.edit', $goal->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('metas.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                            Nenhuma meta encontrada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para os gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados para o gráfico de distribuição de valores
        const goals = @json($goals);
        
        // Gráfico de Distribuição de Valores
        const valueCtx = document.getElementById('valueDistributionChart').getContext('2d');
        new Chart(valueCtx, {
            type: 'bar',
            data: {
                labels: goals.map(goal => goal.goal_title),
                datasets: [{
                    label: 'Valor Atual',
                    data: goals.map(goal => goal.current_value),
                    backgroundColor: 'rgba(79, 70, 229, 0.5)',
                    borderColor: 'rgb(79, 70, 229)',
                    borderWidth: 1
                }, {
                    label: 'Valor Restante',
                    data: goals.map(goal => goal.target_value - goal.current_value),
                    backgroundColor: 'rgba(156, 163, 175, 0.5)',
                    borderColor: 'rgb(156, 163, 175)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toFixed(2);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': R$ ' + context.raw.toFixed(2);
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Distribuição por Categoria
        const categoryCtx = document.getElementById('categoryDistributionChart').getContext('2d');
        const categories = [...new Set(goals.map(goal => goal.goal_category))];
        const categoryData = categories.map(category => {
            return goals.filter(goal => goal.goal_category === category).length;
        });

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categories,
                datasets: [{
                    data: categoryData,
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(59, 130, 246, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>
