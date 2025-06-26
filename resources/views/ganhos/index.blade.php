<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-2 md:px-0">
        <div class="flex justify-between items-center p-4 md:p-6 mb-8 border-b-2 border-primary-1 shadow-sm">
            <h2 class="text-3xl font-bold text-primary-1">
                Ganhos
            </h2>
            <div class="text-right">
                <p class="text-sm text-gray-600">Seu saldo atual</p>
                <p class="text-xl font-semibold text-gray-800">{{number_format($user_rent, 2, ',', '.')}}</p>
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
        
        <!-- Botão Nova Meta -->
        <div class="mb-6">
            <a href="{{ route('ganhos.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-1 active:bg-primary-1 focus:outline-none focus:border-primary-1 focus:ring ring-primary-1 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Novo ganho
            </a>
        </div>
        <!-- Filtros -->
        <form method="GET" class="bg-white shadow rounded-xl p-4 mb-6 flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="title" value="{{ request('title') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary" placeholder="Buscar por título...">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Recorrência</label>
                <select name="recurrence" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary">
                    <option value="">Todas</option>
                    @foreach($recurrences as $rec)
                        <option value="{{ $rec }}" @if(request('recurrence') == $rec) selected @endif>{{ ucfirst($rec) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Data inicial</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Data final</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary">
            </div>
            <div>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-primary-1 transition">Filtrar</button>
            </div>
        </form>
        <!-- Tabela de Ganhos -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-8">
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-primary-1">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Título</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Valor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Recorrência</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Recebido em</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($earnings as $earning)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ \Illuminate\Support\Str::limit($earning->title) }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="text-base font-bold text-green-700">R$ {{ number_format($earning->value, 2, ',', '.') }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($earning->recurrence === 'mensal') bg-blue-100 text-blue-800
                                        @elseif($earning->recurrence === 'única') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($earning->recurrence) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($earning->received_at)->format('d/m/Y') }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('ganhos.show', $earning) }}" class="text-primary hover:text-primary-1" title="Ver detalhes">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('ganhos.edit', $earning) }}" class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400">Nenhum ganho cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $earnings->links() }}
                </div>
            </div>
        </div>
        <!-- Gráficos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
                <h3 class="font-bold text-lg mb-4 text-black">Ganhos por mês</h3>
                <canvas id="earningsByMonthChart" class="w-full max-w-xs md:max-w-full h-64"></canvas>
            </div>
            <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
                <h3 class="font-bold text-lg mb-4 text-black">Ganhos por recorrência</h3>
                <canvas id="earningsByRecurrenceChart" class="w-full max-w-xs md:max-w-full h-64"></canvas>
            </div>
        </div>
    </div>
        @push('scripts')
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Gráfico de Ganhos por Mês
            const ctxMonth = document.getElementById('earningsByMonthChart').getContext('2d');
            const earningsByMonth = @json($earningsByMonth);
            const monthLabels = earningsByMonth.map(item => `${item.month.toString().padStart(2, '0')}/${item.year}`);
            const monthData = earningsByMonth.map(item => item.total);
            new Chart(ctxMonth, {
                type: 'bar',
                data: {
                    labels: monthLabels.reverse(),
                    datasets: [{
                        label: 'Ganhos por mês',
                        data: monthData.reverse(),
                        backgroundColor: [
                            '#11999e', '#38bdf8', '#f59e42', '#f87171', '#a78bfa', '#34d399', '#fbbf24', '#f472b6', '#818cf8', '#f87171', '#f59e42', '#38bdf8'
                        ],
                        borderRadius: 12,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
            // Gráfico de Ganhos por Recorrência
            const ctxRec = document.getElementById('earningsByRecurrenceChart').getContext('2d');
            const earningsByRecurrence = @json($earningsByRecurrence);
            const recLabels = earningsByRecurrence.map(item => item.recurrence.charAt(0).toUpperCase() + item.recurrence.slice(1));
            const recData = earningsByRecurrence.map(item => item.total);
            new Chart(ctxRec, {
                type: 'doughnut',
                data: {
                    labels: recLabels,
                    datasets: [{
                        label: 'Total',
                        data: recData,
                        backgroundColor: [
                            '#f87171', '#34d399', '#fbbf24', '#818cf8', '#38bdf8', '#a78bfa', '#f59e42', '#11999e'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        </script>
    @endpush
</x-app-layout>