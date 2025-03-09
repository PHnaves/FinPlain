<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Meta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Criar Nova Meta</h1>

                    @if(session('error'))
                        <div class="text-red-500">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('metas.store') }}" method="POST">
                        @csrf
                        
                        <input type="text" name="titulo" placeholder="Título da Meta" required>
                        @error('titulo') <p class="text-red-500">{{ $message }}</p> @enderror

                        <textarea name="descricao" placeholder="Descrição (opcional)"></textarea>
                        @error('descricao') <p class="text-red-500">{{ $message }}</p> @enderror

                        <input type="number" name="valor_final" placeholder="Valor Final (R$)" required>
                        @error('valor_final') <p class="text-red-500">{{ $message }}</p> @enderror

                        <input type="number" name="valor_atual" placeholder="Valor atual já guardado (R$)">
                        @error('valor_atual') <p class="text-red-500">{{ $message }}</p> @enderror

                        <input type="number" name="valor_periodico" placeholder="Valor a Guardar por Período (R$)" required>
                        @error('valor_periodico') <p class="text-red-500">{{ $message }}</p> @enderror

                        <label for="periodicidade">Periodicidade:</label>
                        <select name="periodicidade" id="periodicidade" required>
                            <option value="semanal">Semanal</option>
                            <option value="mensal">Mensal</option>
                        </select>
                        @error('periodicidade') <p class="text-red-500">{{ $message }}</p> @enderror

                        <label for="status">Status:</label>
                        <select name="status" id="status" required>
                            <option value="andamento">Em andamento</option>
                            <option value="concluída">Concluída</option>
                            <option value="cancelada">Cancelada</option>
                        </select>

                        <button type="submit">Salvar Meta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
