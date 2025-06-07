<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
                    <h2 class="text-3xl font-bold text-primary-1">🔔 Minhas Notificações</h2>

                    <form method="GET" action="{{ route('notifications') }}" class="flex items-center justify-center md:justify-end">
                        <select name="type" onchange="this.form.submit()" 
                            class="w-full md:w-auto rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            <option value="">Todas as notificações</option>
                            <option value="despesa_vencida" {{ request('type') == 'despesa_vencida' ? 'selected' : '' }}>Despesas Vencidas</option>
                            <option value="deposito_meta" {{ request('type') == 'deposito_meta' ? 'selected' : '' }}>Depósitos de Metas</option>
                            <option value="valor_limite_despesa" {{ request('type') == 'valor_limite_despesa' ? 'selected' : '' }}>Despesas Excedentes</option>
                        </select>
                    </form>
                </div>


                        @if($notifications->isEmpty())
                            <div class="text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-1">Nenhuma notificação</h3>
                                <p class="text-gray-500">Você não tem notificações no momento.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($notifications as $notification)
                                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden {{ is_null($notification->read_at) ? 'border-l-4 border-l-primary' : '' }}">
                                        <div class="p-4">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-2">
                                                        @if($notification->data['tipo'] === 'valor_limite_despesa')
                                                            <div class="p-2 rounded-full bg-red-100 text-red-600">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                                </svg>
                                                            </div>
                                                        @elseif($notification->data['tipo'] === 'despesa_vencida')
                                                            <div class="p-2 rounded-full bg-yellow-100 text-yellow-600">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="p-2 rounded-full bg-green-100 text-green-600">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                        <span class="text-sm font-medium text-gray-500">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p class="text-gray-700">{{ $notification->data['mensagem'] }}</p>
                                                </div>
                                                <div class="flex items-center space-x-2 ml-4">
                                                    @if(is_null($notification->read_at))
                                                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-primary-3 bg-primary-1 hover:bg-primary-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                                                Marcar como lida
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
