<x-app-layout>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
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
            <!-- Formulário -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm text-center">
                    📝 Nova Meta
                </h2>

                <form action="{{ route('metas.store') }}" method="POST" class="space-y-6">
                    @include('metas.components.form')
                </form>
            </div>

            <!-- Card de publicidade -->
            <div class="h-[400px] bg-gradient-to-br from-emerald-500 to-emerald-700 text-white rounded-lg shadow-md p-4 flex flex-col justify-between">
                <div>
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
                    </ul>
                </div>
                <div class="mt-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/2382/2382533.png" alt="Dicas" class="w-20 mx-auto">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
