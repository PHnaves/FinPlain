<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edita Metas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="max-w-4xl mx-auto mt-10 bg-gray-800 p-6 rounded-lg shadow-md">
                        <h2 class="text-white text-2xl font-semibold mb-4">Editar Meta</h2> 
                        <!-- Formulário para editar usuário -->
                        <form action="{{ route('metas.update', $goal->id ) }}" method="post" class="space-y-6">
                            @method('patch')
                            @include('metas.components.form')
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
