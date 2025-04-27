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

                    <h1 class="text-2xl font-bold mb-4">Detalhes da Meta</h1>

                    <div class="flex flex-col space-y-4 w-full">

                        <h2 class="text-3xl font-bold">{{ $goal->goal_title }}</h2>

                        <p class="text-lg">
                            {{ $goal->goal_description ?? 'Descrição não fornecida' }}
                        </p>

                        <p class="text-xl"><strong>Categoria: </strong>{{ $goal->goal_category ?? 'Não definida' }}</p>

                        <p class="text-xl"><strong>Valor Final:</strong> R$ {{ number_format($goal->target_value, 2, ',', '.') }}</p>

                        <p class="text-xl"><strong>Valor Atual:</strong> R$ {{ number_format($goal->current_value, 2, ',', '.') }}</p>

                        <p class="text-xl"><strong>Valor a Guardar por Período:</strong> R$ {{ number_format($goal->recurring_value, 2, ',', '.') }}</p>

                        <p class="text-xl"><strong>Frequência:</strong> <span class="font-semibold">{{ ucfirst($goal->frequency) }}</span></p>

                        <p class="text-xl"><strong>Data Final:</strong> {{ \Carbon\Carbon::parse($goal->end_date)->format('d/m/Y') ?? 'Não definida' }}</p>

                        <h4 class="text-lg font-bold mt-6">Progresso da Meta</h4>
                        <p><strong>Depósitos Restantes:</strong> {{ $deposits_number }}</p>
                        <p><strong>Data Estimada de Conclusão:</strong> {{ $conclusion_date }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($message) }}</p>

                        <div class="text-gray-500 text-sm mt-4">
                            <p>Postado em: {{ $goal->created_at->format('d/m/Y H:i') }}</p>

                            @if (is_null($goal->updated_at) || $goal->updated_at == $goal->created_at)
                                <p>Meta Ainda Não Editada</p>
                            @else
                                <p>Editada em: {{ $goal->updated_at->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>

                        <!-- Ações -->
                        <div class="flex flex-wrap items-center space-x-4 mt-6">
                            <!-- Form de Depósito (oculto) -->
                            <form action="{{ route('deposito', $goal->id) }}" method="POST" class="flex flex-col space-y-2">
                                @csrf
                                <input type="number" name="deposit_value" placeholder="Valor do depósito" required min="1" class="p-2 rounded-lg text-black">
                                <button type="submit" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition hover:bg-green-500">
                                    Confirmar Depósito
                                </button>
                            </form>

                            <!-- Excluir Meta -->
                            <form action="{{ route('metas.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('DELETE')
                                <button class="py-2 px-6 rounded-lg bg-red-600 text-white text-sm font-semibold shadow-md transition hover:bg-red-500">
                                    Excluir Meta
                                </button>
                            </form>

                            <!-- Editar -->
                            <a href="{{ route('metas.edit', $goal->id) }}" class="py-2 px-6 rounded-lg bg-yellow-600 text-white text-sm font-semibold shadow-md transition hover:bg-yellow-500">
                                Editar Meta
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
