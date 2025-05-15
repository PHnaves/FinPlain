<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transações</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        {{-- Cards Topo --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg p-6 shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Resumo do Mês</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Total de Despesas</p>
                        <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($metrics['total_expenses'], 2, ',', '.') }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Média por Despesa</p>
                        <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($metrics['average_expense'], 2, ',', '.') }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Pago</p>
                        <p class="text-2xl font-bold text-green-600">R$ {{ number_format($metrics['paid_expenses'], 2, ',', '.') }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Pendente</p>
                        <p class="text-2xl font-bold text-red-600">R$ {{ number_format($metrics['pending_expenses'], 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold mb-2">Controle seus gastos</h3>
                    <p class="text-sm text-indigo-100">Economize mais com o nosso painel de despesas inteligente.</p>
                </div>
                <div class="mt-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331970.png" alt="Publicidade" class="w-28 mx-auto">
                </div>
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

        {{-- Gráficos e Análises --}}
        <div class="space-y-4">
            {{-- Status de Pagamento --}}
            <div class="bg-white rounded-lg p-4 shadow">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Status de Pagamento</h3>
                <div class="flex items-center justify-center">
                    <div class="w-48 h-48">
                        <canvas id="paymentStatusChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Gráficos de Análise --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribuição por Categoria</h3>
                    <div class="h-96 flex items-center justify-center">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tendência Mensal</h3>
                    <div class="h-96 flex items-center justify-center">
                        <canvas id="monthlyTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuração global do Chart.js
            Chart.defaults.font.family = "'Figtree', sans-serif";
            Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            Chart.defaults.plugins.tooltip.padding = 12;
            Chart.defaults.plugins.tooltip.cornerRadius = 8;
            Chart.defaults.plugins.tooltip.titleFont = { size: 14, weight: 'bold' };
            Chart.defaults.plugins.tooltip.bodyFont = { size: 13 };
            Chart.defaults.animation.duration = 1000;

            // Gráfico de Status de Pagamento
            const paymentStatusCtx = document.getElementById('paymentStatusChart');
            if (paymentStatusCtx) {
                new Chart(paymentStatusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($paymentStatus->keys()) !!},
                        datasets: [{
                            data: {!! json_encode($paymentStatus->values()) !!},
                            backgroundColor: ['#10B981', '#EF4444'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 10,
                                    font: {
                                        size: 12,
                                        weight: '500'
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: R$ ${value.toLocaleString('pt-BR', {minimumFractionDigits: 2})} (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
            }

            // Gráfico de Distribuição por Categoria
            const categoryCtx = document.getElementById('categoryChart');
            if (categoryCtx) {
                new Chart(categoryCtx, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($categoryData->keys()) !!},
                        datasets: [{
                            data: {!! json_encode($categoryData->values()) !!},
                            backgroundColor: [
                                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                                '#EC4899', '#14B8A6', '#F97316', '#6366F1', '#A855F7'
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    padding: 20,
                                    font: {
                                        size: 13,
                                        weight: '500'
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: R$ ${value.toLocaleString('pt-BR', {minimumFractionDigits: 2})} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Gráfico de Tendência Mensal
            const monthlyTrendCtx = document.getElementById('monthlyTrendChart');
            if (monthlyTrendCtx) {
                new Chart(monthlyTrendCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyData->keys()->map(function($date) {
                            return \Carbon\Carbon::parse($date)->format('M/Y');
                        })) !!},
                        datasets: [{
                            label: 'Total de Despesas',
                            data: {!! json_encode($monthlyData->values()) !!},
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3,
                            pointBackgroundColor: '#3B82F6',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `R$ ${context.raw.toLocaleString('pt-BR', {minimumFractionDigits: 2})}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return 'R$ ' + value.toLocaleString('pt-BR');
                                    },
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
