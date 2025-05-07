<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nova Despesa</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Formulário -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('despesas.store') }}" method="POST" class="space-y-4">
                    @include('despesas.components.form')
                </form>
            </div>

            <!-- Card de publicidade -->
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-semibold mb-2">Controle seus gastos</h3>
                    <p class="text-sm text-indigo-100">Economize mais com o nosso painel de despesas inteligente.</p>
                </div>
                <div class="mt-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331970.png" alt="Publicidade" class="w-28 mx-auto">
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
                installmentsInput.value = 1;
            } else {
                installmentsField.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', toggleInstallments);
        recurrence.addEventListener('change', toggleInstallments);
    </script>
</x-app-layout>
