<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Verificar E-mail') }}</h2>
        <p class="text-sm text-gray-600">
            {{ __('Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar? Se você não recebeu o e-mail, ficaremos felizes em enviar outro.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm text-green-600">
                {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
            </p>
        </div>
    @endif

    <div class="space-y-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center bg-primary hover:bg-primary-1 focus:ring-primary">
                {{ __('Reenviar E-mail de Verificação') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>
