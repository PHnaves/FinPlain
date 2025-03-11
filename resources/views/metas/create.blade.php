<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Meta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Criar Nova Meta</h1>

                    @if(session('error'))
                        <div class="text-red-500">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('metas.store') }}" method="POST">
                        @include('metas.components.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
