<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Metas ja criadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <h1>Minhas Metas Financeiras</h1>

                    <a href="{{ route('metas.create') }}">Criar Nova Meta</a>

                    <ul>
                        @foreach($goals as $goal)
                            <li>
                                <strong>{{ $goal->goal_title }}</strong> - R$ {{ $goal->current_value }} / R$ {{ $goal->target_value }}
                                <progress value="{{ $goal->current_value }}" max="{{ $goal->target_value }}"></progress>
                                <span>Status: {{ ucfirst($goal->status) }}</span>
                                <a href="{{ route('metas.show' , $goal->id) }}">Detalhes</a>
                            </li>
                        @endforeach
                    </ul>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
