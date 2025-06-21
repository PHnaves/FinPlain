<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center"> <!-- Centralização horizontal -->
            <div class="w-full max-w-3xl bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-bold text-primary-1 p-4 md:p-6 border-b-2 border-primary-1 shadow-sm text-center">
                    📈 Novo Ganho
                </h2>

                <form action="{{ route('ganhos.store') }}" method="POST" class="space-y-6">
                    @include('ganhos.components.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
