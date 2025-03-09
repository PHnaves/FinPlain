<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Despesas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1>Minhas Despesas</h1>

                    <form action="{{ route('despesa.store') }}" method="POST">
                        @csrf
                        <input type="text" name="tipo" placeholder="Nome da despesa" required>
                        <input type="number" name="valor" placeholder="Valor" required>
                
                        <!-- Select para definir se a despesa é recorrente -->
                        <label for="recorrente">Despesa recorrente?</label>
                        <select name="recorrente" id="recorrente" required>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                
                        <input type="date" name="data_vencimento" placeholder="Data de Vencimento (Opcional)">
                
                        <button type="submit">Salvar</button>
                    </form>
                
                    <ul>
                        @foreach($despesas as $despesa)
                            <li>
                                {{ $despesa->tipo }} - R$ {{ $despesa->valor }}  
                                @if($despesa->recorrente)
                                    <span style="color: green;">(Recorrente)</span>
                                @else
                                    <span style="color: red;">(Não Recorrente)</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
