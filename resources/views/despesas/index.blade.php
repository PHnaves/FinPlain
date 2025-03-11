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

                    <form action="{{ route('despesas.store') }}" method="POST">
                        @include('despesas.components.form')
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
                                
                                <a href="{{ route('despesas.show' , $despesa->id) }}">Detalhes</a>
                            </li>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
