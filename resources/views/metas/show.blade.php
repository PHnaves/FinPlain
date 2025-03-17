<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhe da Meta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1>Detalhes da Meta</h1>
                    <!-- Informações da Meta -->
                    <div class="flex flex-col space-y-4 w-full">
                        <h2 class="text-3xl font-bold">{{ $meta->titulo }}</h2>
                        <p class="text-lg">{{ $meta->descricao ?? 'Descrição não fornecida' }}</p>
                        <p class="text-xl"><strong>Valor Final: </strong>{{ $meta->valor_final }} R$</p>
                        <p class="text-xl"><strong>Valor Atual: </strong>{{ $meta->valor_atual }} R$</p>
                        <p class="text-xl"><strong>Valor Periódico: </strong>{{ $meta->valor_periodico }} R$</p>
                        <h4>Progresso da Meta</h4>
                        <p><strong>Depósitos Restantes:</strong> {{ $numero_depositos }}</p>
                        <p><strong>Data Estimada de Conclusão:</strong> {{ $data_conclusao }}</p>
                        <p><strong>Status:</strong> {{ $mensagem }}</p>
                        <span class="text-2xl font-bold text-blue-600">{{ ucfirst($meta->periodicidade) }} </span>
                        <div class="text-gray-500 text-sm">
                            <p>Postado em: {{ $meta->created_at }}</p>
                            {{-- Lógica para mostrar se a meta foi editada ou não --}}
                            @if (is_null($meta->updated_at) || $meta->updated_at == $meta->created_at)
                                <p>Meta Ainda Não Editada</p>
                            @else
                                <p>Editada em: {{ $meta->updated_at }}</p>
                            @endif
                        </div>
                        
                        <div class="flex justify-start space-x-6 mt-4">
                            <!-- Botão para exibir o input de depósito -->
                            <button id="depositar-btn" class="py-2 px-6 rounded-lg bg-blue-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Depositar
                            </button>

                            <!-- Formulário de depósito (inicialmente oculto) -->
                            <form id="depositar-form" action="{{ route('metas.update', $meta->id) }}" method="POST" style="display: none;" class="flex flex-col space-y-2">
                                @csrf
                                <input type="number" name="valor_deposito" placeholder="Valor do depósito" required min="1" class="p-2 rounded-lg text-black">
                                <button type="submit" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Confirmar Depósito
                                </button>
                            </form>

                            <!-- Formulário para excluir Meta -->
                            <form action="{{ route('metas.destroy', $meta->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('delete')
                                <button class="py-2 px-6 rounded-lg bg-red-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 cursor-pointer">
                                    Excluir Meta
                                </button>
                            </form>
                            
                            <!-- Botão para ir para a página de editar Meta -->
                            <a href="{{ route('metas.edit', $meta->id) }}" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Editar Meta
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
