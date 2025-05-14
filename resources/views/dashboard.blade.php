<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total de Despesas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de Despesas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ count($expense_name) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Despesas Pendentes -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Despesas Pendentes</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $expense_status->filter(function($status) { return $status === 'nao_pago'; })->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total de Metas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-3 text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de Metas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ count($goal_title) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metas Concluídas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Metas Concluídas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goal_progress->filter(function($progress) { return $progress >= 100; })->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Gráfico de Metas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Progresso das Metas</h3>
                            <a href="{{ route('metas.index') }}" class="text-sm text-primary hover:text-primary-1">Ver todas</a>
                        </div>
                        <div class="h-80">
                            <canvas id="goalsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Gastos -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Gastos por Categoria</h3>
                            <a href="{{ route('despesas.index') }}" class="text-sm text-primary hover:text-primary-1">Ver todas</a>
                        </div>
                        <div class="h-80">
                            <canvas id="gastosChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('despesas.create') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Nova Despesa</p>
                                <p class="text-sm text-gray-500">Registrar gasto</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('metas.create') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-3 text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Nova Meta</p>
                                <p class="text-sm text-gray-500">Criar objetivo</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('despesas.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver Despesas</p>
                                <p class="text-sm text-gray-500">Lista completa</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('metas.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver Metas</p>
                                <p class="text-sm text-gray-500">Lista completa</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ===== Gráfico de Metas =====
        const goalTitles = @json($goal_title);
        const goalProgress = @json($goal_progress);
        const goalIds = @json($goal_ids);

        const goalsCtx = document.getElementById('goalsChart').getContext('2d');
        const goalsChart = new Chart(goalsCtx, {
            type: 'bar',
            data: {
                labels: goalTitles,
                datasets: [{
                    label: 'Progresso (%)',
                    data: goalProgress,
                    backgroundColor: '#11999E',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Progresso (%)'
                        }
                    }
                },
                onClick: function (e) {
                    const activePoints = goalsChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                    if (activePoints.length > 0) {
                        const clickedIndex = activePoints[0].index;
                        window.location.href = "/goal/" + goalIds[clickedIndex] + "/show";
                    }
                }
            }
        });

        // ===== Gráfico de Gastos =====
        const expenseNames = @json($expense_name);
        const expenseValues = @json($expense_value);
        const expenseIds = @json($expense_ids);
        const expenseStatus = @json($expense_status);

        // Cores baseadas no status de pagamento
        const expenseColors = expenseStatus.map(status => status === 'nao_pago' ? '#ef4444' : '#3b82f6');

        const gastosCtx = document.getElementById('gastosChart').getContext('2d');
        const gastosChart = new Chart(gastosCtx, {
            type: 'bar',
            data: {
                labels: expenseNames,
                datasets: [{
                    label: 'Valor da Despesa (R$)',
                    data: expenseValues,
                    backgroundColor: expenseColors,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
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
                },
                onClick: function (e) {
                    const activePoints = gastosChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                    if (activePoints.length > 0) {
                        const clickedIndex = activePoints[0].index;
                        window.location.href = "/expense/" + expenseIds[clickedIndex] + "/show";
                    }
                }
            }
        });
    </script>
</x-app-layout>
