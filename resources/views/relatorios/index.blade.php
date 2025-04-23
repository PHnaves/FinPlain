<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Relatório de Gastos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Filtrar Gastos</h3>
                        <form action="{{ route('relatorios.filtrar') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Data Início:</label>
                                    <input type="date" name="data_inicio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Data Fim:</label>
                                    <input type="date" name="data_fim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tipo:</label>
                                    <select name="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Todos</option>
                                        <option value="1">Necessários</option>
                                        <option value="0">Não Necessários</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filtrar
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(isset($gastos))
                        <div class="mt-8">
                            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold mb-2">Resumo</h3>
                                <p>Total de Gastos: R$ {{ number_format($total, 2, ',', '.') }}</p>
                                <p>Quantidade de Gastos: {{ $gastos->count() }}</p>
                                <p>Média por Gasto: R$ {{ number_format($gastos->count() > 0 ? $total / $gastos->count() : 0, 2, ',', '.') }}</p>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Data</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Descrição</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Valor</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Necessário</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($gastos as $gasto)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($gasto->created_at)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $gasto->descricao }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    R$ {{ number_format($gasto->valor, 2, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $gasto->necessario == 'sim' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $gasto->necessario == 'sim' ? 'Sim' : 'Não' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <form action="{{ route('relatorio.gerar') }}" method="GET">
                                    <input type="hidden" name="data_inicio" value="{{ request('data_inicio') ?? '' }}">
                                    <input type="hidden" name="data_fim" value="{{ request('data_fim') ?? '' }}">
                                    <input type="hidden" name="tipo" value="{{ request('tipo') ?? '' }}">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Gerar PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 