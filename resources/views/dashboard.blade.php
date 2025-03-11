<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <h1>Painel Financeiro</h1>

                <div>
                    <h2>Resumo Financeiro</h2>
                    <p>Total de Gastos: R$ {{ $total_gastos }}</p>
                    <p>Saldo Disponível: R$ {{ $saldo_disponivel }}</p>
                </div>


                <div>
                    <h2>Progresso das Metas</h2>
                    <canvas id="metasChart"></canvas>
                </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Dados do gráfico de progresso das metas
                var ctx2 = document.getElementById('metasChart').getContext('2d');
                var metasChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: @json($metas_titulos),
                        datasets: [{
                            label: 'Progresso (%)',
                            data: @json($metas_progresso),
                            backgroundColor: '#4caf50'
                        }]
                    },
                    options: {
                        onClick: function(e) {
                            // Pega o elemento clicado
                            var activePoints = metasChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                            if (activePoints.length > 0) {
                                var clickedIndex = activePoints[0].index;
                                // Redireciona para a página de detalhes da meta
                                var metasTitulos = @json($metas_titulos); // O título da meta
                                var metasIds = @json($metas_ids); // IDs das metas para redirecionamento correto
                                window.location.href = "/meta/" + metasIds[clickedIndex] + "/show"; // Ajuste conforme a sua rota
                            }
                        }
                    }
                });
            </script>
            
            





                </div>
            </div>
        </div>
    </div>
</x-app-layout>
