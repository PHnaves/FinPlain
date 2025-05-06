<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nova Despesa</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('despesas.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @include('despesas.components.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 