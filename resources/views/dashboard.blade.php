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
                    <h2>Progresso das Metas</h2>
                    <canvas id="metasChart"></canvas>
                </div>

                <div>
                    <h2>Gastos</h2>
                    <canvas id="gastosChart"></canvas>
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


                // Gráfico de Gastos
                var ctxGastos = document.getElementById('gastosChart').getContext('2d');

                var gastosNecessarios = [];
                var gastosNaoNecessarios = [];

                var gastosValores = @json($gastos_valores);
                var gastosNecessariosFlags = @json($gastos_necessarios);
                
                gastosValores.forEach((valor, index) => {
                    if (gastosNecessariosFlags[index] === 'sim') {
                        gastosNecessarios.push(valor);
                        gastosNaoNecessarios.push(0); // Zera os não necessários para manter a estrutura
                    } else {
                        gastosNecessarios.push(0); // Zera os necessários para manter a estrutura
                        gastosNaoNecessarios.push(valor);
                    }
                });

                var gastosChart = new Chart(ctxGastos, {
                    type: 'bar',
                    data: {
                        labels: @json($gastos_titulos),
                        datasets: [
                            {
                                label: 'Gastos Necessários',
                                data: gastosNecessarios,
                                backgroundColor: '#4caf50'
                            },
                            {
                                label: 'Gastos Não Necessários',
                                data: gastosNaoNecessarios,
                                backgroundColor: '#ff0000'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        onClick: function(e) {
                            var activePoints = gastosChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, false);
                            if (activePoints.length > 0) {
                                var clickedIndex = activePoints[0].index;
                                var gastosIds = @json($gastos_ids);
                                window.location.href = "/gasto/" + gastosIds[clickedIndex] + "/show";
                            }
                        }
                    }
                });

            </script>

                // Script do Easy Peasy Bot
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
