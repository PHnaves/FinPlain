<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Gasto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <h1>Detalhes Do Gasto</h1>
                {{ $gasto->descricao }} - R$ {{ $gasto->valor }}  
                @if($gasto->necessario == 'sim')
                    <span style="color: green;">(Necessario)</span>
                @else
                    <span style="color: red;">(Não Necessario)</span>
                @endif

                <p>Gasto criado em: {{ $gasto->created_at }}</p>            

                {{-- formulario ara excluir o gasto --}}
                <form action="{{ route('gastos.destroy', $gasto->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button>Excluir Gasto</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>