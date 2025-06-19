<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Cadastrar Ganho</h2>
        <form action="{{ route('ganhos.store') }}" method="POST">
            @include('ganhos.components.form')
        </form>
    </div>
</x-app-layout> 