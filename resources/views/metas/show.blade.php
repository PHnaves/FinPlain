<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhe da Meta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold">{{ $goal->goal_title }}</h1>
                            <p class="text-gray-600 mt-2">{{ $goal->goal_category }}</p>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($goal->status === 'concluída') bg-green-100 text-green-800
                            @elseif($goal->status === 'andamento') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($goal->status) }}
                        </span>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Informações Principais -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Descrição</h3>
                                <p class="text-gray-700">{{ $goal->goal_description ?? 'Descrição não fornecida' }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Valores</h3>
                                <div class="space-y-2">
                                    <p class="flex justify-between">
                                        <span class="text-gray-600">Valor Final:</span>
                                        <span class="font-semibold">R$ {{ number_format($goal->target_value, 2, ',', '.') }}</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span class="text-gray-600">Valor Atual:</span>
                                        <span class="font-semibold">R$ {{ number_format($goal->current_value, 2, ',', '.') }}</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span class="text-gray-600">Valor por Período:</span>
                                        <span class="font-semibold">R$ {{ number_format($goal->recurring_value, 2, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Progresso e Datas -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Progresso</h3>
                                <div class="mb-2">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>R$ {{ number_format($goal->current_value, 2, ',', '.') }}</span>
                                        <span>R$ {{ number_format($goal->target_value, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ min(($goal->current_value / $goal->target_value) * 100, 100) }}%"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    <span class="font-semibold">Data Estimada de Conclusão:</span> {{ $conclusion_date }}
                                </p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Detalhes</h3>
                                <div class="space-y-2">
                                    <p class="flex justify-between">
                                        <span class="text-gray-600">Frequência:</span>
                                        <span class="font-semibold">{{ ucfirst($goal->frequency) }}</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span class="text-gray-600">Data Final:</span>
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($goal->end_date)->format('d/m/Y') ?? 'Não definida' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações -->
                    <div class="flex flex-wrap gap-4 mt-6">
                        <!-- Form de Depósito -->
                        @if($goal->status !== 'concluída')
                            <form action="{{ route('deposit.goal', $goal->id) }}" method="POST" class="flex-1">
                                @csrf
                                <div class="flex gap-2">
                                    <input type="number" 
                                           name="deposit_value" 
                                           placeholder="Valor do depósito" 
                                           required 
                                           min="0.01" 
                                           step="0.01" 
                                           max="{{ $goal->target_value - $goal->current_value }}"
                                           class="flex-1 p-2 rounded-lg text-black border border-gray-300">
                                    <button type="submit" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition hover:bg-green-500">
                                        Confirmar Depósito
                                    </button>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    Valor máximo permitido: R$ {{ number_format($goal->target_value - $goal->current_value, 2, ',', '.') }}
                                </p>
                            </form>
                        @else
                            <div class="flex-1 p-4 bg-gray-50 rounded-lg">
                                <p class="text-gray-600">Esta meta já foi concluída. Não é possível realizar mais depósitos.</p>
                            </div>
                        @endif

                        <div class="flex gap-2">
                            <!-- Editar -->
                            <a href="{{ route('metas.edit', $goal->id) }}" class="py-2 px-6 rounded-lg bg-yellow-600 text-white text-sm font-semibold shadow-md transition hover:bg-yellow-500">
                                Editar Meta
                            </a>

                            <!-- Excluir Meta -->
                            <form action="{{ route('metas.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('DELETE')
                                <button class="py-2 px-6 rounded-lg bg-red-600 text-white text-sm font-semibold shadow-md transition hover:bg-red-500">
                                    Excluir Meta
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-gray-500 text-sm mt-6">
                        <p>Postado em: {{ $goal->created_at->format('d/m/Y H:i') }}</p>
                        @if (is_null($goal->updated_at) || $goal->updated_at == $goal->created_at)
                            <p>Meta Ainda Não Editada</p>
                        @else
                            <p>Editada em: {{ $goal->updated_at->format('d/m/Y H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
