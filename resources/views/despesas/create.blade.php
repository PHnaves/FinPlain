<x-app-layout>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Formulário -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm text-center">
                    🧾 Nova Transação
                </h2>
                
                <form action="{{ route('despesas.store') }}" method="POST" class="space-y-4">
                    @include('despesas.components.form')
                </form>
            </div>

            <!-- Card de publicidade -->
            <div class="h-[400px] md:h-[500px] bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold mb-2">Controle seus gastos</h3>
                    <p class="text-sm text-indigo-100">Economize mais com o nosso painel de transações inteligente.</p>
                </div>
                <div class="mt-2">
                    <img src="{{ asset('/images/Despesas-removebg.png') }}" alt="Publicidade" class="w-full h-auto max-h-[300px] object-contain">
                </div>
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
