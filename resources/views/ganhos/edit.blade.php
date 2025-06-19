<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Editar Ganho</h2>
        <form action="{{ route('ganhos.update', $earning) }}" method="POST">
            @method('PUT')
            @include('ganhos.components.form')
        </form>
    </div>
</x-app-layout> 