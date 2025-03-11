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
                        <h2 class="text-3xl font-bold text-gray-800">{{ $meta->titulo }}</h2>
                        <p class="text-lg text-gray-600">{{ $meta->descricao ?? 'Descrição não fornecida' }}</p>
                        <p class="text-xl text-gray-800"><strong>Valor Final: </strong>{{ $meta->valor_final }} R$</p>
                        <p class="text-xl text-gray-800"><strong>Valor Atual: </strong>{{ $meta->valor_atual }} R$</p>
                        <p class="text-xl text-gray-800"><strong>Valor Periódico: </strong>{{ $meta->valor_periodico }} R$</p>
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
