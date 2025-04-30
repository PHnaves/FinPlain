<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Despesas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">


                    <h1>Minhas Despesas</h1>

                    <a href="{{ route('records.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ver Relatórios
                    </a>

                    <form action="{{ route('despesas.store') }}" method="POST">
                        @include('despesas.components.form')
                    </form>
                
                    <ul>
                        @foreach($expenses as $expense)
                            <li>
                                {{ $expense->expense_name }} - R$ {{ $expense->expense_value }}  
                                
                                <a href="{{ route('despesas.show' , $expense->id) }}">Detalhes</a>
                            </li>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
