<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Meus Ganhos</h2>
            <a href="{{ route('ganhos.create') }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-1 transition">Novo Ganho</a>
        </div>
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Valor</th>
                        <th class="px-4 py-2">Recorrência</th>
                        <th class="px-4 py-2">Recebido em</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($earnings as $earning)
                        <tr>
                            <td class="border px-4 py-2">{{ $earning->title }}</td>
                            <td class="border px-4 py-2">R$ {{ number_format($earning->value, 2, ',', '.') }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($earning->recurrence) }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($earning->received_at)->format('d/m/Y') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('ganhos.show', $earning) }}" class="text-blue-600 hover:underline mr-2">Ver</a>
                                <a href="{{ route('ganhos.edit', $earning) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                                <form action="{{ route('ganhos.destroy', $earning) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Tem certeza que deseja remover este ganho?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum ganho cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>