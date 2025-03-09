<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Metas ja criadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1>Minhas Metas Financeiras</h1>

                    <a href="{{ route('metas.create') }}">Criar Nova Meta</a>

                    <ul>
                        @foreach($metas as $meta)
                            <li>
                                <strong>{{ $meta->titulo }}</strong> - R$ {{ $meta->valor_atual }} / R$ {{ $meta->valor_final }}
                                <progress value="{{ $meta->valor_atual }}" max="{{ $meta->valor_final }}"></progress>
                                <span>Status: {{ ucfirst($meta->status) }}</span>
                            </li>
                        @endforeach
                    </ul>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
