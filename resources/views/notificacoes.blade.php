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

                    <div class="container">
                        <h1>Minhas Notificações</h1>

                        <form method="GET" action="{{ route('notifications') }}" class="mb-4">
                            <select name="type" onchange="this.form.submit()" class="form-select">
                                <option value="">Todas</option>
                                <option value="despesa_vencida" {{ request('type') == 'despesa_vencida' ? 'selected' : '' }}>Despesas Vencidas</option>
                                <option value="deposito_meta" {{ request('type') == 'deposito_meta' ? 'selected' : '' }}>Depósitos de Metas</option>
                                <option value="valor_limite_despesa" {{ request('type') == 'valor_limite_despesa' ? 'selected' : '' }}>Despesas Excedentes</option>
                            </select>
                        </form>

                        @foreach($notifications as $notification)
                            <div class="card mb-3 {{ is_null($notification->read_at) ? 'bg-light' : 'bg-white' }}">
                                <div class="card-body">
                                    <p>{{ $notification->data['mensagem'] }}</p>

                                    @if(is_null($notification->read_at))
                                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Marcar como lida</button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        {{ $notifications->links() }}
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
