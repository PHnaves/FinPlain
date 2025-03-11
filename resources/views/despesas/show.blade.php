<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhe Despesa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1>Detalhe Das Despesas</h1>
                                        <!-- Informações do produto -->
                    <div class="flex flex-col space-y-4 w-full">
                        <h2 class="text-3xl font-bold text-gray-800">{{ $despesa->tipo }}</h2>
                        <p class="text-lg text-gray-600">{{ $despesa->valor }}</p>
                        <span class="text-2xl font-bold text-blue-600">{{ $despesa->recorrente}} </span>
                        <div class="text-gray-500 text-sm">
                            <p>Postado em: {{ $despesa->created_at }}</p>
                            {{-- logica para mostrar se a Despesa foi editada ou nao --}}
                            @if (is_null($despesa->updated_at) || $despesa->updated_at == $despesa->created_at)
                                <p>Despesa Ainda Não Editada</p>
                            @else
                                <p>Editado em: {{ $despesa->updated_at }}</p>
                            @endif
                        </div>
                        
                        <div class="flex justify-start space-x-6 mt-4">
                            <!-- Form de excluir Despesa -->
                            <form action="{{ route('despesas.destroy', $despesa->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta despesa?');">
                                @csrf
                                @method('delete')
                                <button class="py-2 px-6 rounded-lg bg-red-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 cursor-pointer">
                                    Excluir Despesa
                                </button>
                            </form>
                            
                            <!-- Botão Para ir Para Pagina de Editar depesa -->
                            <a href="{{ route('despesas.edit', $despesa->id) }}" class="py-2 px-6 rounded-lg bg-green-600 text-white text-sm font-semibold shadow-md transition-all duration-300 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Editar Despesa
                            </a>
                        </div>
                    </div>
                    



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
