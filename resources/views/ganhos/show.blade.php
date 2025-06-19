<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Detalhes do Ganho</h2>
        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Título:</strong> {{ $earning->title }}</p>
            <p><strong>Descrição:</strong> {{ $earning->description }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($earning->value, 2, ',', '.') }}</p>
            <p><strong>Recorrência:</strong> {{ ucfirst($earning->recurrence) }}</p>
            <p><strong>Recebido em:</strong> {{ \Carbon\Carbon::parse($earning->received_at)->format('d/m/Y') }}</p>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('ganhos.edit', $earning) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mr-2">Editar</a>
            <form action="{{ route('ganhos.destroy', $earning) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este ganho?')">
                @csrf
                @method('DELETE')
                <label for="subtrair_renda" class="mr-2">Diminuir valor da renda atual?</label>
                <select name="subtrair_renda" id="subtrair_renda" class="rounded-md mr-2">
                    <option value="nao">Não</option>
                    <option value="sim">Sim</option>
                </select>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Excluir</button>
            </form>
        </div>
        <div class="mt-4">
            <a href="{{ route('ganhos.index') }}" class="text-blue-600 hover:underline">Voltar para lista de ganhos</a>
        </div>
    </div>
</x-app-layout> 