<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <h1>Painel Financeiro</h1>
                <h1>Painel Financeiro</h1>

                        <div>
                            <h2>Progresso das Metas</h2>
                            <canvas id="goalsChart"></canvas>
                        </div>

                        <div>
                            <h2>Gastos</h2>
                            <canvas id="gastosChart"></canvas>
                        </div>

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
                                        backgroundColor: '#4caf50'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    onClick: function (e) {
                                        const activePoints = goalsChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                                        if (activePoints.length > 0) {
                                            const clickedIndex = activePoints[0].index;
                                            window.location.href = "/meta/" + goalIds[clickedIndex] + "/show";
                                        }
                                    }
                                }
                            });

                            // ===== Gráfico de Gastos =====
                            const expenseNames = @json($expense_name);
                            const expenseValues = @json($expense_value);
                            const expenseIds = @json($expense_ids);
                            const expenseStatus = @json($expense_status); // novo

                            // Cores baseadas no status de pagamento
                            const expenseColors = expenseStatus.map(status => status === 'nao_pago' ? '#f44336' : '#2196f3');

                            const gastosCtx = document.getElementById('gastosChart').getContext('2d');
                            const gastosChart = new Chart(gastosCtx, {
                                type: 'bar',
                                data: {
                                    labels: expenseNames,
                                    datasets: [{
                                        label: 'Valor da Despesa (R$)',
                                        data: expenseValues,
                                        backgroundColor: expenseColors
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    },
                                    onClick: function (e) {
                                        const activePoints = gastosChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                                        if (activePoints.length > 0) {
                                            const clickedIndex = activePoints[0].index;
                                            window.location.href = "/despesa/" + expenseIds[clickedIndex] + "/show";
                                        }
                                    }
                                }
                            });
                        </script>



                {{-- Script do Easy Peasy Bot --}}
                <script src="https://bots.easy-peasy.ai/chat.min.js"
                    data-chat-url="https://bots.easy-peasy.ai/bot/efb32a87-79f0-4547-b415-5b176ecd7bfe"
                    data-btn-position="bottom-right"
                    data-widget-btn-color="#12de75" 
                    defer> 
                </script>

            
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
