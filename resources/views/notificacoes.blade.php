<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notificações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                <h1>Notificações</h1>

                @foreach($notificacoes as $notificacao)
                    <div style="background: {{ $notificacao->lida ? '#ddd' : '#f8d7da' }}; padding: 10px; margin-bottom: 10px;">
                        <p>{{ $notificacao->mensagem }}</p>
                        @if(!$notificacao->lida)
                            <a href="{{ route('marcar_notificacao_lida', $notificacao->id) }}">Marcar como lida</a>
                        @endif
                    </div>
                @endforeach


                </div>
            </div>
        </div>
    </div>
</x-app-layout>