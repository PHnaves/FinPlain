<title>FinPlan | Recuperar senha</title>

<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Recuperar senha') }}</h2>
        <p class="text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problemas. Informe seu e-mail e enviaremos um link para redefinir sua senha.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="email" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="email@mail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button class="w-full justify-center bg-primary hover:bg-primary-1 focus:ring-primary">
                {{ __('Enviar link de recuperação') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-primary hover:text-primary-1">
                {{ __('Voltar para o login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
