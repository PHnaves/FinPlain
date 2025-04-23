<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sugestão de Investimentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Investimentos Recomendados para seu Perfil</h3>
                        <p class="text-sm text-gray-600">
                            Com base no seu perfil de investidor, aqui estão algumas sugestões de investimentos que podem se adequar aos seus objetivos.
                        </p>
                    </div>

                    @if($investimentos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($investimentos as $investimento)
                                <div class="bg-white rounded-lg shadow-md p-6">
                                    <h4 class="text-lg font-semibold mb-2">{{ $investimento->nome }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ $investimento->descricao }}</p>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Tipo:</span>
                                            <span class="text-sm">{{ $investimento->tipo }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Prazo:</span>
                                            <span class="text-sm">{{ $investimento->prazo }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Valor Recomendado:</span>
                                            <span class="text-sm">R$ {{ number_format($investimento->valor_recomendado, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600">
                                No momento, não há investimentos recomendados para o seu perfil.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>