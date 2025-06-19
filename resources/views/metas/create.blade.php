<x-app-layout>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Card de publicidade (dicas e imagem maiores) -->
            <div class="lg:col-span-3 flex justify-center mb-2">
                <div class="w-full max-w-2xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg shadow-md p-3 flex flex-col md:flex-row items-center justify-between h-auto">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold mb-3">Dicas para suas metas</h3>
                        <ul class="space-y-2 text-sm text-emerald-100">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Defina metas realistas e mensuráveis
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Acompanhe seu progresso regularmente
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Celebre cada conquista
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Divida grandes metas em etapas menores
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Revise e ajuste suas metas conforme necessário
                            </li>
                        </ul>
                    </div>
                    <div class="ml-6 flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('/images/Metas-removebg.png') }}" alt="Dicas" class="w-56 h-40 object-contain drop-shadow-lg">
                    </div>
                </div>
            </div>
            <!-- Formulário -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm text-center">
                    📝 Nova Meta
                </h2>

                <form action="{{ route('metas.store') }}" method="POST" class="space-y-6">
                    @include('metas.components.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>