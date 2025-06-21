<x-app-layout>
    <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm">
        💰 Detalhes do Ganho '{{ $earning->title }}'
    </h2>

    <x-modal name="confirm-earning-deletion" :show="$errors->earningDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('ganhos.destroy', $earning) }}" class="p-6">
            @csrf
            @method('delete')
            <div class="flex flex-col items-center justify-center min-h-[300px]">
                <div class="flex items-center justify-center mb-6">
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-lg font-medium text-gray-900 text-center mb-4">
                    Tem certeza que deseja excluir este ganho?
                </h2>
                <p class="mt-1 text-sm text-gray-600 text-center mb-6 max-w-md">
                    Esta ação não pode ser desfeita. Todos os dados relacionados a este ganho serão permanentemente excluídos.
                </p>
                <div class="mb-6 w-full max-w-md flex flex-col items-center">
                    <label for="subtrair_renda" class="block text-sm font-medium text-gray-700 mb-2 text-center">Deseja subtrair o valor deste ganho da sua renda atual?</label>
                    <select name="subtrair_renda" id="subtrair_renda" class="w-48 border-gray-300 rounded-lg shadow-sm focus:ring-primary focus:border-primary text-center">
                        <option value="nao">Não</option>
                        <option value="sim">Sim</option>
                    </select>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-4 w-full max-w-md">
                    <x-secondary-button x-on:click="$dispatch('close')" class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Cancelar
                    </x-secondary-button>
                    <x-danger-button class="flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Excluir Ganho
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 pb-6 border-b">
                        <div class="w-full md:w-auto">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 break-words">{{ $earning->title }}</h1>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-primary-3 text-primary">
                                    {{ ucfirst($earning->recurrence) }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    R$ {{ number_format($earning->value, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 w-full md:w-auto flex flex-col items-start md:items-end gap-2">
                            <p class="text-sm text-gray-500">
                                Recebido em: {{ \Carbon\Carbon::parse($earning->received_at)->format('d/m/Y') }}
                            </p>
                            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                                <a href="{{ route('ganhos.edit', $earning) }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Editar Ganho
                                </a>
                                <button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-earning-deletion')"
                                    class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-500 transition"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Excluir Ganho
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Descrição</p>
                                <p class="text-gray-700 break-words">{{ $earning->description ?? 'Descrição não fornecida' }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Recebido em</p>
                                <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($earning->received_at)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 