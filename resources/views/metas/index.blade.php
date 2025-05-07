<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Minhas Metas Financeiras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Total de Metas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Total de Metas</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $goals->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metas Concluídas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Concluídas</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $goals->where('status', 'concluída')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metas em Andamento -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Em Andamento</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $goals->where('status', 'andamento')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metas Canceladas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Canceladas</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $goals->where('status', 'cancelada')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Gráfico de Distribuição por Status -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribuição por Status</h3>
                        <canvas id="goalsStatusChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Gráfico de Distribuição por Categoria -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribuição por Categoria</h3>
                        <canvas id="goalsCategoryChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Lista de Metas -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">Lista de Metas</h3>
                        <a href="{{ route('metas.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                            Criar Nova Meta
                        </a>
                    </div>

                    <div class="space-y-6">
                        @foreach($goals as $goal)
                            <div class="border rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-800">{{ $goal->goal_title }}</h4>
                                        <p class="text-gray-600">{{ $goal->goal_category }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if($goal->status === 'concluída') bg-green-100 text-green-800
                                        @elseif($goal->status === 'andamento') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($goal->status) }}
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>R$ {{ number_format($goal->current_value, 2, ',', '.') }}</span>
                                        <span>R$ {{ number_format($goal->target_value, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ min(($goal->current_value / $goal->target_value) * 100, 100) }}%"></div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-600">
                                        <p>Frequência: {{ ucfirst($goal->frequency) }}</p>
                                        <p>Valor por Período: R$ {{ number_format($goal->recurring_value, 2, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('metas.show', $goal->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para os gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados para os gráficos
        const goals = @json($goals);
        
        // Gráfico de Distribuição por Status
        const statusCtx = document.getElementById('goalsStatusChart').getContext('2d');
        const statusData = {
            concluída: goals.filter(goal => goal.status === 'concluída').length,
            andamento: goals.filter(goal => goal.status === 'andamento').length,
            cancelada: goals.filter(goal => goal.status === 'cancelada').length
        };

        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: ['Concluídas', 'Em Andamento', 'Canceladas'],
                datasets: [{
                    data: [statusData.concluída, statusData.andamento, statusData.cancelada],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // Gráfico de Distribuição por Categoria
        const categories = {};
        goals.forEach(goal => {
            categories[goal.goal_category] = (categories[goal.goal_category] || 0) + 1;
        });

        const categoryCtx = document.getElementById('goalsCategoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(categories),
                datasets: [{
                    data: Object.values(categories),
                    backgroundColor: [
                        '#4f46e5',
                        '#7c3aed',
                        '#2563eb',
                        '#3b82f6',
                        '#60a5fa'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>
</x-app-layout>
