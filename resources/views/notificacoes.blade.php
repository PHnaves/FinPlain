<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Notificações</h1>

                    @foreach($notificacoes as $notificacao)
                        <div class="{{ $notificacao->lida ? 'bg-gray-200' : 'bg-red-100' }} p-4 mb-4 rounded-lg">
                            <p class="text-gray-800">{{ $notificacao->mensagem }}</p>

                            @if(!$notificacao->lida)
                                <a href="{{ route('marcar_notificacao_lida', $notificacao->id) }}" class="text-blue-500 hover:underline">
                                    Marcar como lida
                                </a>
                            @endif

                            @if ($notificacao->lida)
                                <form action="{{ route('notificacoes.destroy', $notificacao->id) }}" method="post" class="mt-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-500 hover:underline">
                                        Excluir Notificação
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
