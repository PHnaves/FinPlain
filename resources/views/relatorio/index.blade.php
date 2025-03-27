<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerar Relatório de Gastos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('relatorio.gerar') }}" method="GET" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="data_inicio" :value="__('Data Inicial')" />
                                <x-text-input id="data_inicio" name="data_inicio" type="date" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('data_inicio')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="data_fim" :value="__('Data Final')" />
                                <x-text-input id="data_fim" name="data_fim" type="date" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('data_fim')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Gerar Relatório') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 