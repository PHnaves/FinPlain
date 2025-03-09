<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rendas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1>Minha Renda</h1>
                    <form action="{{ route('renda.store') }}" method="POST">
                        @csrf
                        <input type="number" name="valor" placeholder="Valor da renda" required>
                        <button type="submit">Salvar</button>
                    </form>
                    <ul>
                        @foreach($rendas as $renda)
                            <li>{{ $renda->valor }}</li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
