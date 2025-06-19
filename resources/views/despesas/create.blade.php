<x-app-layout>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Card de publicidade (igual ao de metas) -->
            <div class="lg:col-span-3 flex justify-center mb-2">
                <div class="w-full max-w-2xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg shadow-md p-3 flex flex-col md:flex-row items-center justify-between h-auto">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold mb-3">Dicas para controlar suas despesas</h3>
                        <ul class="space-y-2 text-sm text-emerald-100">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Registre todas as suas despesas, mesmo as pequenas
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Categorize seus gastos para identificar excessos
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Defina limites para cada categoria
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Reveja seus gastos semanalmente
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Busque oportunidades para economizar
                            </li>
                        </ul>
                    </div>
                    <div class="ml-6 flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('/images/Despesas-removebg.png') }}" alt="Dicas" class="w-56 h-40 object-contain drop-shadow-lg">
                    </div>
                </div>
            </div>
            <!-- Formulário -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm text-center">
                    🧾 Nova Transação
                </h2>
                <form action="{{ route('despesas.store') }}" method="POST" class="space-y-4">
                    @include('despesas.components.form')
                </form>
            </div>
        </div>
    </div>

    <!-- Script para exibir ou esconder parcelas -->
    <script>
        const recurrence = document.getElementById('recurrence');
        const installmentsField = document.getElementById('installments_field');
        const installmentsInput = document.getElementById('installments');

        function toggleInstallments() {
            if (recurrence.value === 'a vista') {
                installmentsField.style.display = 'none';
                installmentsInput.value = 0;
            } else {
                installmentsField.style.display = 'block';
                if (installmentsInput.value === '0') {
                    installmentsInput.value = 1;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', toggleInstallments);
        recurrence.addEventListener('change', toggleInstallments);
    </script>
</x-app-layout>