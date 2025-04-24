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

                    @if($investiments->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($investiments as $investiment)
                                <div class="bg-white rounded-lg shadow-md p-6">
                                    <h4 class="text-lg font-semibold mb-2">{{ $investiment->investiment_name }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ $investiment->investiment_description }}</p>
                                    
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Tipo:</span>
                                            <span class="text-sm">{{ $investiment->investiment_type }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Data de Expiração:</span>
                                            <span class="text-sm">{{ $investiment->expiration_date }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium">Valor Minimo:</span>
                                            <span class="text-sm">R$ {{ number_format($investiment->minimum_value, 2, ',', '.') }}</span>
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