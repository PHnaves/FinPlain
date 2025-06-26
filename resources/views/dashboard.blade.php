<x-app-layout>

    <div class="flex justify-between items-center p-4 md:p-6 border-b-2 border-primary-1 shadow-sm">
        <div>
            <h2 class="text-3xl font-bold text-primary-1">Dashboard</h2>
            <p class="text-lg text-gray-600 mt-1">Bem-vindo, <span class="font-semibold text-gray-800">{{ $user->name }}</span> 👋</p>
        </div>

        <div class="text-right">
            <p class="text-sm text-gray-600">Seu saldo atual</p>
            <p class="text-xl font-semibold text-gray-800">
                {{ number_format($user->rent, 2, ',', '.') }}
            </p>
        </div>
    </div>

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Cards de Resumo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total de Transações -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de transações</p>
                                <p class="text-lg font-semibold text-gray-900">{{ count($expense_name) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transações Pendentes -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Transações pendentes</p>
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
                                <p class="text-sm font-medium text-gray-600">Total de metas</p>
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
                                <p class="text-sm font-medium text-gray-600">Metas concluídas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $goal_progress->filter(function($progress) { return $progress >= 100; })->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtros</h3>
                    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Ano</label>
                            <div class="relative">
                                <select name="year" id="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary appearance-none bg-white">
                                    @foreach($availableYears as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Mês</label>
                            <div class="relative">
                                <select name="month" id="month" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary appearance-none bg-white">
                                    <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Janeiro</option>
                                    <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Fevereiro</option>
                                    <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Março</option>
                                    <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>Abril</option>
                                    <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Maio</option>
                                    <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Junho</option>
                                    <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Julho</option>
                                    <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agosto</option>
                                    <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>Setembro</option>
                                    <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Outubro</option>
                                    <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>Novembro</option>
                                    <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Dezembro</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-primary hover:bg-primary-1 text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-300">
                                Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cards de Resumo Financeiro -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <!-- Total de Ganhos -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total de ganhos</p>
                                <p class="text-lg font-semibold text-green-600">R$ {{ number_format($totalEarnings, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <p class="text-sm font-medium text-gray-600">Total de despesas</p>
                                <p class="text-lg font-semibold text-red-600">R$ {{ number_format($totalExpenses, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saldo -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full {{ $balance >= 0 ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Saldo</p>
                                <p class="text-lg font-semibold {{ $user->rent >= 0 ? 'text-blue-600' : 'text-orange-600' }}">
                                    R$ {{ number_format($user->rent, 2, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Gráfico de Ganhos x Despesas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Ganhos x Despesas</h3>
                            <a href="{{ route('ganhos.index') }}" class="text-sm text-primary hover:text-primary-1">Ver todos</a>
                        </div>
                        <div class="h-80">
                            <canvas id="earningsVsExpensesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Evolução Mensal -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Evolução mensal</h3>
                            <span class="text-sm text-gray-500">Últimos 12 meses</span>
                        </div>
                        <div class="h-80">
                            <canvas id="monthlyEvolutionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Secundário -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Gráfico de Metas -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Progresso das metas</h3>
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
                            <h3 class="text-lg font-semibold text-gray-900">Gastos por categoria</h3>
                            <a href="{{ route('despesas.index') }}" class="text-sm text-primary hover:text-primary-1">Ver todas</a>
                        </div>
                        <div class="h-80">
                            <canvas id="gastosChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Nova Despesa -->
                <a href="{{ route('despesas.create') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Nova transação</p>
                                <p class="text-sm text-gray-500">Registrar gasto</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Novo Ganho -->
                <a href="{{ route('ganhos.create') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Novo ganho</p>
                                <p class="text-sm text-gray-500">Registrar receita</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Nova Meta -->
                <a href="{{ route('metas.create') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-primary-3 text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Nova meta</p>
                                <p class="text-sm text-gray-500">Criar objetivo</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Ver Transações -->
                <a href="{{ route('despesas.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver transações</p>
                                <p class="text-sm text-gray-500">Lista completa</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Ver Ganhos -->
                <a href="{{ route('ganhos.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver ganhos</p>
                                <p class="text-sm text-gray-500">Lista completa</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Ver Metas -->
                <a href="{{ route('metas.index') }}" class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver metas</p>
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
        // ===== Gráfico de Ganhos x Despesas =====
        const earningTitles = @json($earning_title);
        const earningValues = @json($earning_value);
        const earningIds = @json($earning_ids);

        const earningsVsExpensesCtx = document.getElementById('earningsVsExpensesChart').getContext('2d');
        const earningsVsExpensesChart = new Chart(earningsVsExpensesCtx, {
            type: 'bar',
            data: {
                labels: earningTitles,
                datasets: [{
                    label: 'Ganhos (R$)',
                    data: earningValues,
                    backgroundColor: '#10b981',
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
                    const activePoints = earningsVsExpensesChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                    if (activePoints.length > 0) {
                        const clickedIndex = activePoints[0].index;
                        window.location.href = "/earning/" + earningIds[clickedIndex] + "/show";
                    }
                }
            }
        });

        // ===== Gráfico de Evolução Mensal =====
        const monthlyData = @json($monthlyData);
        const monthlyLabels = monthlyData.map(item => item.month);
        const monthlyExpenses = monthlyData.map(item => item.expenses);
        const monthlyEarnings = monthlyData.map(item => item.earnings);

        const monthlyEvolutionCtx = document.getElementById('monthlyEvolutionChart').getContext('2d');
        const monthlyEvolutionChart = new Chart(monthlyEvolutionCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Ganhos',
                    data: monthlyEarnings,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Despesas',
                    data: monthlyExpenses,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
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
                }
            }
        });

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
